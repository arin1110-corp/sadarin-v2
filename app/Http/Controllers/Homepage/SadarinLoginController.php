<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\SadarinUserRole;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SadarinLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('LoginPage.index');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI LOGIN
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'nip' => ['required', 'string', 'max:100'],

                'password' => ['required', 'string', 'max:255'],
            ],
            [
                'nip.required' => 'NIP atau NIK wajib diisi.',

                'password.required' => 'Password wajib diisi.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('nip'));
        }

        /*
        |--------------------------------------------------------------------------
        | IDENTIFIER
        |--------------------------------------------------------------------------
        */

        $identifier = trim($request->nip);

        /*
        |--------------------------------------------------------------------------
        | API SAMPERIN
        |--------------------------------------------------------------------------
        */

        $apiUrl = rtrim(config('services.samperin.url'), '/') . '/login';

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(15)
                ->post($apiUrl, [
                'nip' => $identifier,
                'password' => $request->password,
                ]);
        } catch (ConnectionException $e) {
            /*
            |--------------------------------------------------------------------------
            | API TIDAK DAPAT DIHUBUNGI
            |--------------------------------------------------------------------------
            */

            Log::error('SADARIN gagal terhubung ke API SAMPERIN.', [
                'url' => $apiUrl,
                'error' => $e->getMessage(),
            ]);

            SadarinAccessLogService::log(action: 'login.failed', userType: 'user');

            return back()->withInput($request->only('nip'))->with('error', 'Server SAMPERIN tidak dapat dihubungi. Silakan coba lagi.');
        } catch (\Throwable $e) {
            /*
            |--------------------------------------------------------------------------
            | ERROR API
            |--------------------------------------------------------------------------
            */

            Log::error('SADARIN error saat login SAMPERIN.', [
                'url' => $apiUrl,
                'error' => $e->getMessage(),
            ]);

            SadarinAccessLogService::log(action: 'login.failed', userType: 'user');

            return back()->withInput($request->only('nip'))->with('error', 'Terjadi kesalahan saat memproses login.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK RESPONSE SAMPERIN
        |--------------------------------------------------------------------------
        */

        if (!$response->successful()) {
            SadarinAccessLogService::log(action: 'login.failed', userType: 'user');

            return back()->withInput($request->only('nip'))->with('error', 'NIP/NIK atau password salah.');
        }

        /*
        |--------------------------------------------------------------------------
        | PARSE RESPONSE
        |--------------------------------------------------------------------------
        */

        $result = $response->json();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI RESPONSE
        |--------------------------------------------------------------------------
        */

        if (!isset($result['status']) || $result['status'] !== true || !isset($result['data'])) {
            Log::warning('Response login SAMPERIN tidak valid.', [
                'identifier' => $identifier,
                'response' => $result,
            ]);

            SadarinAccessLogService::log(action: 'login.failed', userType: 'user');

            return back()->withInput($request->only('nip'))->with('error', 'Data login dari SAMPERIN tidak valid.');
        }

        /*
        |--------------------------------------------------------------------------
        | DATA PEGAWAI
        |--------------------------------------------------------------------------
        */

        $pegawai = $result['data'];

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA UTAMA
        |--------------------------------------------------------------------------
        */

        $samperinUserId = $pegawai['id'] ?? null;

        $nama = $pegawai['nama'] ?? null;

        $nip = $pegawai['nip'] ?? null;

        $email = $pegawai['email'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | CEK ID PEGAWAI
        |--------------------------------------------------------------------------
        */

        if (!$samperinUserId) {
            Log::warning('Login SAMPERIN berhasil tetapi ID pegawai tidak ditemukan.', [
                'identifier' => $identifier,
            ]);

            SadarinAccessLogService::log(action: 'login.failed', userType: 'user');

            return back()->withInput($request->only('nip'))->with('error', 'Data pegawai tidak lengkap. Silakan hubungi administrator.');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA ROLE SADARIN
        |--------------------------------------------------------------------------
        */

        $roleData = SadarinUserRole::query()->join('sadarin_role', 'sadarin_user_role.user_role_role_id', '=', 'sadarin_role.role_id')->where('sadarin_user_role.user_role_samperin_user_id', $samperinUserId)->where('sadarin_role.role_is_active', true)->select('sadarin_role.role_id', 'sadarin_role.role_name', 'sadarin_role.role_description')->orderBy('sadarin_role.role_id')->get();

        /*
        |--------------------------------------------------------------------------
        | CEK ROLE
        |--------------------------------------------------------------------------
        */

        if ($roleData->isEmpty()) {
            Log::warning('Pegawai belum memiliki role SADARIN.', [
                'samperin_user_id' => $samperinUserId,
                'nip' => $nip,
            ]);

            SadarinAccessLogService::log(action: 'login.no_role', userType: 'user', samperinUserId: $samperinUserId);

            return back()->withInput($request->only('nip'))->with('error', 'Akun Anda belum memiliki hak akses SADARIN. Silakan hubungi administrator.');
        }

        /*
        |--------------------------------------------------------------------------
        | FORMAT ROLE
        |--------------------------------------------------------------------------
        */

        $roles = $roleData
            ->map(function ($role) {
                return [
                    'id' => $role->role_id,

                    'name' => $role->role_name,

                    'description' => $role->role_description,
                ];
            })
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | DATA USER SESSION
        |--------------------------------------------------------------------------
        */

        $userData = [
            'id' => $samperinUserId,

            'nama' => $nama,

            'nip' => $nip,

            'email' => $email,

            'jabatan' => $pegawai['jabatan'] ?? null,

            'jabatan_id' => $pegawai['jabatan_id'] ?? null,

            'bidang_id' => $pegawai['bidang_id'] ?? null,

            'bidang' => $pegawai['bidang'] ?? null,

            'eselon' => $pegawai['eselon'] ?? null,

            'hp' => $pegawai['hp'] ?? null,

            'pendidikan_jenjang' => $pegawai['pendidikan_jenjang'] ?? null,

            'pendidikan_jurusan' => $pegawai['pendidikan_jurusan'] ?? null,

            'golongan_nama' => $pegawai['golongan_nama'] ?? null,

            'golongan_pangkat' => $pegawai['golongan_pangkat'] ?? null,

            'jeniskerja' => $pegawai['jeniskerja'] ?? null,
        ];

        /*
        |--------------------------------------------------------------------------
        | ROLE AKTIF DEFAULT
        |--------------------------------------------------------------------------
        */

        $activeRole = $roles[0];

        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        |
        | Penting untuk mencegah session fixation.
        |
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | SESSION AUTHENTICATED
        |--------------------------------------------------------------------------
        */

        session([
            /*
            |--------------------------------------------------------------------------
            | STATUS LOGIN
            |--------------------------------------------------------------------------
            */

            'sadarin_authenticated' => true,

            /*
            |--------------------------------------------------------------------------
            | DATA USER
            |--------------------------------------------------------------------------
            */

            'sadarin_user_id' => $userData['id'],

            'sadarin_user_nip' => $userData['nip'],

            'sadarin_user_nama' => $userData['nama'],

            'sadarin_user_email' => $userData['email'],

            'sadarin_user_jabatan' => $userData['jabatan'],

            'sadarin_user_bidang' => $userData['bidang'],

            /*
            |--------------------------------------------------------------------------
            | DATA LENGKAP PEGAWAI
            |--------------------------------------------------------------------------
            */

            'sadarin_user' => $userData,

            /*
            |--------------------------------------------------------------------------
            | SEMUA ROLE
            |--------------------------------------------------------------------------
            */

            'sadarin_roles' => $roles,

            /*
            |--------------------------------------------------------------------------
            | ROLE AKTIF
            |--------------------------------------------------------------------------
            */

            'sadarin_role_id' => $activeRole['id'],

            'sadarin_role_name' => $activeRole['name'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | LOG LOGIN SUCCESS
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'login.success', userType: $activeRole['name'], samperinUserId: $samperinUserId);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT SESUAI ROLE
        |--------------------------------------------------------------------------
        */

        return $this->redirectByRole($activeRole['name'], $nama);
    }

    /*
    |--------------------------------------------------------------------------
    | SWITCH ROLE
    |--------------------------------------------------------------------------
    */

    public function switchRole(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!session('sadarin_authenticated')) {
            return redirect()->route('sadarin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'role_id' => ['required', 'integer'],
            ],
            [
                'role_id.required' => 'Role wajib dipilih.',

                'role_id.integer' => 'Role tidak valid.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE ID
        |--------------------------------------------------------------------------
        */

        $roleId = (int) $request->role_id;

        /*
        |--------------------------------------------------------------------------
        | AMBIL ROLE DARI SESSION
        |--------------------------------------------------------------------------
        */

        $roles = session('sadarin_roles', []);

        /*
        |--------------------------------------------------------------------------
        | CARI ROLE
        |--------------------------------------------------------------------------
        */

        $selectedRole = collect($roles)->firstWhere('id', $roleId);

        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK DIMILIKI
        |--------------------------------------------------------------------------
        */

        if (!$selectedRole) {
            Log::warning('Percobaan switch ke role yang tidak dimiliki.', [
                'user_id' => session('sadarin_user_id'),

                'requested_role_id' => $roleId,
            ]);

            return back()->with('error', 'Anda tidak memiliki akses ke role tersebut.');
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ROLE AKTIF
        |--------------------------------------------------------------------------
        */

        session([
            'sadarin_role_id' => $selectedRole['id'],

            'sadarin_role_name' => $selectedRole['name'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | LOG SWITCH ROLE
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'role.switch', userType: $selectedRole['name'], samperinUserId: session('sadarin_user_id'));

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return $this->redirectByRole($selectedRole['name'], session('sadarin_user_nama'));
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT BY ROLE
    |--------------------------------------------------------------------------
    */

    private function redirectByRole(string $roleName, ?string $nama = null)
    {
        /*
        |--------------------------------------------------------------------------
        | SUCCESS MESSAGE
        |--------------------------------------------------------------------------
        */

        $message = $nama ? 'Selamat datang, ' . $nama . '.' : null;

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return match ($roleName) {
            'Administrator' => redirect()->route('sadarin.admin.dashboard.index')->with('success', $message),

            'Arsiparis' => redirect('/sadarin/arsiparis/dashboard')->with('success', $message),

            'Pengguna Internal' => redirect()->route('sadarin.user.archive.index')->with('success', $message),

            default => redirect()->route('sadarin.login')->with('error', 'Role akun tidak dikenali.'),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | LOG LOGOUT
        |--------------------------------------------------------------------------
        */

        if (session('sadarin_authenticated')) {
            SadarinAccessLogService::log(
                action: 'logout',

                userType: session('sadarin_role_name'),

                samperinUserId: session('sadarin_user_id'),
            );
        }

        /*
        |--------------------------------------------------------------------------
        | INVALIDATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        /*
        |--------------------------------------------------------------------------
        | REGENERATE CSRF TOKEN
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------

        */

        return redirect()->route('homepage')->with('success', 'Anda telah keluar dari SADARIN.');
    }
}
