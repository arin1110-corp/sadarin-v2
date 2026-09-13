<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_role_permission', function (Blueprint $table) {
            $table->id('role_permission_id');

            $table->unsignedBigInteger(
                'role_permission_role_id'
            );

            $table->unsignedBigInteger(
                'role_permission_permission_id'
            );

            $table->timestamp(
                'role_permission_created_at'
            )->useCurrent();

            $table->timestamp(
                'role_permission_updated_at'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | UNIQUE
            |--------------------------------------------------------------------------
            */

            $table->unique(
                [
                    'role_permission_role_id',
                    'role_permission_permission_id',
                ],
                'role_perm_unique'
            );

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index(
                'role_permission_role_id',
                'role_perm_role_idx'
            );

            $table->index(
                'role_permission_permission_id',
                'role_perm_perm_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_role_permission');
    }
};