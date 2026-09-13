<?php

namespace Database\Seeders;

use App\Models\SadarinPermission;
use App\Models\SadarinRole;
use App\Models\SadarinRolePermission;
use Illuminate\Database\Seeder;

class SadarinRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        $administrator = SadarinRole::updateOrCreate(
            [
                'role_name' => 'Administrator',
            ],
            [
                'role_description' => 'Memiliki akses penuh terhadap seluruh fitur SADARIN.',
                'role_is_active' => true,
            ],
        );

        $arsiparis = SadarinRole::updateOrCreate(
            [
                'role_name' => 'Arsiparis',
            ],
            [
                'role_description' => 'Mengelola, memeriksa, dan memverifikasi arsip.',
                'role_is_active' => true,
            ],
        );

        $penggunaInternal = SadarinRole::updateOrCreate(
            [
                'role_name' => 'Pengguna Internal',
            ],
            [
                'role_description' => 'Pengguna internal yang dapat mengajukan dan mengakses arsip sesuai hak akses.',
                'role_is_active' => true,
            ],
        );

        /*
        |--------------------------------------------------------------------------
        | PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $permissions = [
            [
                'permission_name' => 'archive.view',
                'permission_label' => 'Lihat Arsip',
                'permission_description' => 'Melihat data dan detail arsip.',
            ],
            [
                'permission_name' => 'archive.create',
                'permission_label' => 'Tambah Arsip',
                'permission_description' => 'Membuat dan mengajukan arsip baru.',
            ],
            [
                'permission_name' => 'archive.update',
                'permission_label' => 'Ubah Arsip',
                'permission_description' => 'Mengubah data dan metadata arsip.',
            ],
            [
                'permission_name' => 'archive.delete',
                'permission_label' => 'Hapus Arsip',
                'permission_description' => 'Menghapus arsip.',
            ],
            [
                'permission_name' => 'archive.restore',
                'permission_label' => 'Pulihkan Arsip',
                'permission_description' => 'Memulihkan arsip yang telah dihapus.',
            ],
            [
                'permission_name' => 'archive.download',
                'permission_label' => 'Unduh Arsip',
                'permission_description' => 'Mengunduh file arsip.',
            ],
            [
                'permission_name' => 'archive.verify',
                'permission_label' => 'Verifikasi Arsip',
                'permission_description' => 'Memverifikasi atau menolak pengajuan arsip.',
            ],

            [
                'permission_name' => 'tag.view',
                'permission_label' => 'Lihat Tag',
                'permission_description' => 'Melihat daftar tag arsip.',
            ],
            [
                'permission_name' => 'tag.manage',
                'permission_label' => 'Kelola Tag',
                'permission_description' => 'Menambah, mengubah, dan menghapus tag.',
            ],

            [
                'permission_name' => 'document_type.view',
                'permission_label' => 'Lihat Jenis Dokumen',
                'permission_description' => 'Melihat daftar jenis dokumen.',
            ],
            [
                'permission_name' => 'document_type.manage',
                'permission_label' => 'Kelola Jenis Dokumen',
                'permission_description' => 'Menambah, mengubah, dan menghapus jenis dokumen.',
            ],

            [
                'permission_name' => 'user_role.view',
                'permission_label' => 'Lihat Role Pengguna',
                'permission_description' => 'Melihat pembagian role pengguna SADARIN.',
            ],
            [
                'permission_name' => 'user_role.manage',
                'permission_label' => 'Kelola Role Pengguna',
                'permission_description' => 'Mengatur role pengguna internal SADARIN.',
            ],

            [
                'permission_name' => 'access_log.view',
                'permission_label' => 'Lihat Log Akses',
                'permission_description' => 'Melihat riwayat akses dan aktivitas arsip.',
            ],

            [
                'permission_name' => 'survey.view',
                'permission_label' => 'Lihat Survey',
                'permission_description' => 'Melihat data survey dan hasil tanggapan.',
            ],
            [
                'permission_name' => 'survey.manage',
                'permission_label' => 'Kelola Survey',
                'permission_description' => 'Membuat dan mengelola survey.',
            ],

            [
                'permission_name' => 'setting.manage',
                'permission_label' => 'Kelola Pengaturan',
                'permission_description' => 'Mengelola pengaturan sistem SADARIN.',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | CREATE / UPDATE PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $permissionModels = [];

        foreach ($permissions as $permissionData) {
            $permission = SadarinPermission::updateOrCreate(
                [
                    'permission_name' => $permissionData['permission_name'],
                ],
                [
                    'permission_label' => $permissionData['permission_label'],
                    'permission_description' => $permissionData['permission_description'],
                    'permission_is_active' => true,
                ],
            );

            $permissionModels[$permission->permission_name] = $permission;
        }

        /*
        |--------------------------------------------------------------------------
        | ADMINISTRATOR
        |--------------------------------------------------------------------------
        | Administrator mendapatkan seluruh permission.
        |--------------------------------------------------------------------------
        */

        foreach ($permissionModels as $permission) {
            SadarinRolePermission::firstOrCreate([
                'role_permission_role_id' => $administrator->role_id,
                'role_permission_permission_id' => $permission->permission_id,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ARSIPARIS
        |--------------------------------------------------------------------------
        */

        $arsiparisPermissions = ['archive.view', 'archive.create', 'archive.update', 'archive.download', 'archive.verify', 'tag.view', 'document_type.view', 'access_log.view'];

        foreach ($arsiparisPermissions as $permissionName) {
            $permission = $permissionModels[$permissionName];

            SadarinRolePermission::firstOrCreate([
                'role_permission_role_id' => $arsiparis->role_id,
                'role_permission_permission_id' => $permission->permission_id,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PENGGUNA INTERNAL
        |--------------------------------------------------------------------------
        */

        $penggunaInternalPermissions = ['archive.view', 'archive.create', 'archive.update', 'archive.download'];

        foreach ($penggunaInternalPermissions as $permissionName) {
            $permission = $permissionModels[$permissionName];

            SadarinRolePermission::firstOrCreate([
                'role_permission_role_id' => $penggunaInternal->role_id,
                'role_permission_permission_id' => $permission->permission_id,
            ]);
        }
    }
}