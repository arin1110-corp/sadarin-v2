<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinPermission;
use App\Models\SadarinRole;
use App\Models\SadarinRolePermission;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SadarinRolePermissionController extends Controller
{
    /**
     * Tampilkan permission berdasarkan role.
     */
    public function edit($roleId)
    {
        $role = SadarinRole::query()->where('role_id', $roleId)->firstOrFail();

        $permissions = SadarinPermission::query()->where('permission_is_active', true)->orderBy('permission_name')->get();

        $permissionIds = SadarinRolePermission::query()->where('role_permission_role_id', $roleId)->pluck('role_permission_permission_id')->toArray();

        return view('admin.role.permission', [
            'role' => $role,
            'permissions' => $permissions,
            'permissionIds' => $permissionIds,
        ]);
    }

    /**
     * Simpan permission role.
     */
    public function update(Request $request, $roleId)
    {
        $role = SadarinRole::query()->where('role_id', $roleId)->firstOrFail();

        $validator = Validator::make(
            $request->all(),
            [
                'permission_ids' => ['nullable', 'array'],

                'permission_ids.*' => ['integer', 'exists:sadarin_permission,permission_id'],
            ],
            [
                'permission_ids.array' => 'Format permission tidak valid.',
                'permission_ids.*.integer' => 'Permission tidak valid.',
                'permission_ids.*.exists' => 'Permission tidak ditemukan.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $permissionIds = $request->input('permission_ids', []);

        /*
        |--------------------------------------------------------------------------
        | Pastikan hanya permission aktif yang dapat diberikan
        |--------------------------------------------------------------------------
        */

        $permissionIds = SadarinPermission::query()->whereIn('permission_id', $permissionIds)->where('permission_is_active', true)->pluck('permission_id')->toArray();

        /*
        |--------------------------------------------------------------------------
        | UPDATE MAPPING
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($roleId, $permissionIds) {
            /*
            |--------------------------------------------------------------------------
            | Hapus mapping lama
            |--------------------------------------------------------------------------
            */

            SadarinRolePermission::query()->where('role_permission_role_id', $roleId)->delete();

            /*
            |--------------------------------------------------------------------------
            | Buat mapping baru
            |--------------------------------------------------------------------------
            */

            if (!empty($permissionIds)) {
                $insertData = [];

                foreach ($permissionIds as $permissionId) {
                    $insertData[] = [
                        'role_permission_role_id' => $roleId,
                        'role_permission_permission_id' => $permissionId,
                        'role_permission_created_at' => now(),
                        'role_permission_updated_at' => now(),
                    ];
                }

                SadarinRolePermission::insert($insertData);
            }
        });

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'role.permission.update', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'role', objectId: $role->role_id);

        return redirect()
            ->route('sadarin.admin.role.index')
            ->with('success', 'Permission untuk role "' . $role->role_name . '" berhasil diperbarui.');
    }
}