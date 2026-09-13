<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_access_log', function (Blueprint $table) {
            $table->id('access_log_id');

            $table->uuid('access_log_uid')
                ->unique('access_log_uid_unique');

            $table->unsignedBigInteger(
                'access_log_archive_id'
            )->nullable();

            $table->enum('access_log_user_type', [
                'internal',
                'public',
                'guest',
            ])->default('guest');

            $table->unsignedBigInteger(
                'access_log_samperin_user_id'
            )->nullable();

            $table->unsignedBigInteger(
                'access_log_guestbook_id'
            )->nullable();

            $table->enum('access_log_action', [
                'search',
                'view',
                'download',
                'submit',
                'verify',
                'reject',
                'login',
                'logout',
            ]);

            $table->string(
                'access_log_ip_address',
                45
            )->nullable();

            $table->text(
                'access_log_user_agent'
            )->nullable();

            $table->timestamp(
                'access_log_created_at'
            )->useCurrent();

            $table->index(
                'access_log_archive_id',
                'access_log_archive_idx'
            );

            $table->index(
                'access_log_samperin_user_id',
                'access_log_user_idx'
            );

            $table->index(
                'access_log_guestbook_id',
                'access_log_guest_idx'
            );

            $table->index(
                'access_log_action',
                'access_log_action_idx'
            );

            $table->index(
                'access_log_created_at',
                'access_log_created_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_access_log');
    }
};