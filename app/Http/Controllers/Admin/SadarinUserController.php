<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinRole;
use App\Models\SadarinUserRole;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SadarinUserController extends Controller
{
    /**
     * Daftar pengguna dari SAMPERIN
     */
    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        /*
        |--------------------------------------------------------------------------
        | Ambil Pegawai dari SAMPERIN
        |--------------------------------------------------------------------------
        */

        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->get(rtrim(config('services.samperin.url'), '/') . '/pegawai');

            if (!$response->successful()) {
                return back()->with('error', 'Data pegawai dari SAMPERIN tidak dapat diambil.');
            }

            $responseData = $response->json();

            /*
             * Antisipasi beberapa bentuk response API:
             *
             * {
             *   "data": [...]
             * }
             *
             * atau
             *
             * {
             *   "data": {
             *      "data": [...]
             *   }
             * }
             *
             * atau langsung [...]
             */

            $pegawai = $responseData['data'] ?? $responseData;

            if (is_array($pegawai) && isset($pegawai['data']) && is_array($pegawai['data'])) {
                $pegawai = $pegawai['data'];
            }

            if (!is_array($pegawai)) {
                $pegawai = [];
            }
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal terhubung ke API SAMPERIN.');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Role SADARIN
        |--------------------------------------------------------------------------
        */

        $roles = SadarinRole::query()->where('role_is_active', true)->orderBy('role_name')->get();

        /*
        |--------------------------------------------------------------------------
        | Ambil Assignment Role
        |--------------------------------------------------------------------------
        */

        $userRoles = SadarinUserRole::query()->select('user_role_samperin_user_id', 'user_role_role_id')->get()->groupBy('user_role_samperin_user_id');

        /*
        |--------------------------------------------------------------------------
        | Normalisasi Data Pegawai
        |--------------------------------------------------------------------------
        */

        $pegawai = collect($pegawai)
            ->map(function ($user) use ($userRoles) {
                $userId = $user['id'] ?? ($user['user_id'] ?? null);

                $roles = collect($userRoles->get($userId, collect()));

                $roleIds = $roles->pluck('user_role_role_id')->values()->all();

                return [
                    'id' => $userId,

                    'nip' => $user['nip'] ?? ($user['user_nip'] ?? '-'),

                    'nik' => $user['nik'] ?? ($user['user_nik'] ?? '-'),

                    'nama' => $user['nama'] ?? ($user['name'] ?? ($user['user_nama'] ?? '-')),

                    'jabatan' => $user['jabatan'] ?? ($user['user_jabatan'] ?? '-'),

                    'bidang' => $user['bidang'] ?? ($user['unit'] ?? '-'),

                    'email' => $user['email'] ?? '-',

                    'role_ids' => $roleIds,
                ];
            })
            ->filter(function ($user) use ($search) {
                if (!$search) {
                    return true;
                }

                $keyword = strtolower($search);

                return str_contains(strtolower($user['nip']), $keyword) || str_contains(strtolower($user['nik']), $keyword) || str_contains(strtolower($user['nama']), $keyword) || str_contains(strtolower($user['jabatan']), $keyword) || str_contains(strtolower($user['bidang']), $keyword) || str_contains(strtolower($user['email']), $keyword);
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Pagination Manual
        |--------------------------------------------------------------------------
        */

        $perPage = 20;

        $currentPage = max(1, (int) $request->get('page', 1));

        $total = $pegawai->count();

        $users = new \Illuminate\Pagination\LengthAwarePaginator($pegawai->forPage($currentPage, $perPage)->values(), $total, $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('admin.pengguna.index', compact('users', 'roles'));
    }

    /**
     * Form pengaturan role pengguna
     */
    public function edit($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil Pegawai
        |--------------------------------------------------------------------------
        */

        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->get(rtrim(config('services.samperin.url'), '/') . '/pegawai/' . $id);

            if (!$response->successful()) {
                return redirect()->route('sadarin.admin.pengguna.index')->with('error', 'Data pegawai tidak ditemukan di SAMPERIN.');
            }

            $responseData = $response->json();

            $user = $responseData['data'] ?? $responseData;
        } catch (\Throwable $e) {
            return redirect()->route('sadarin.admin.pengguna.index')->with('error', 'Gagal terhubung ke API SAMPERIN.');
        }

        /*
        |--------------------------------------------------------------------------
        | Role
        |--------------------------------------------------------------------------
        */

        $roles = SadarinRole::query()->where('role_is_active', true)->orderBy('role_name')->get();

        /*
        |--------------------------------------------------------------------------
        | Role Pengguna Saat Ini
        |--------------------------------------------------------------------------
        */

        $userRoleIds = SadarinUserRole::query()->where('user_role_samperin_user_id', $id)->pluck('user_role_role_id')->toArray();

        return view('admin.pengguna.edit', compact('user', 'roles', 'userRoleIds'));
    }

    /**
     * Simpan role pengguna
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_ids' => ['nullable', 'array'],

            'role_ids.*' => ['integer', 'exists:sadarin_role,role_id'],
        ]);

        $roleIds = collect($request->input('role_ids', []))->map(fn($roleId) => (int) $roleId)->unique()->values();

        /*
        |--------------------------------------------------------------------------
        | Pastikan Role Aktif
        |--------------------------------------------------------------------------
        */

        if ($roleIds->isNotEmpty()) {
            $activeRoleCount = SadarinRole::query()->whereIn('role_id', $roleIds)->where('role_is_active', true)->count();

            if ($activeRoleCount !== $roleIds->count()) {
                return back()
                    ->withErrors([
                        'role_ids' => 'Terdapat role yang tidak aktif.',
                    ])
                    ->withInput();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Update Role
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($id, $roleIds) {
            SadarinUserRole::query()->where('user_role_samperin_user_id', $id)->delete();

            foreach ($roleIds as $roleId) {
                SadarinUserRole::create([
                    'user_role_samperin_user_id' => $id,
                    'user_role_role_id' => $roleId,
                ]);
            }
        });

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        |
        | Objek yang diubah adalah pengguna dari SAMPERIN.
        |
        | object_type = user
        | object_id   = ID user SAMPERIN
        |
        */

        SadarinAccessLogService::log(action: 'user.role.update', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'user', objectId: (int) $id);

        return redirect()->route('sadarin.admin.pengguna.index')->with('success', 'Role pengguna berhasil diperbarui.');
    }
}