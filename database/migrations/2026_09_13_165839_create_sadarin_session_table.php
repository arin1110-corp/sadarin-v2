<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_session', function (Blueprint $table) {
            $table->id('session_id');

            $table->uuid('session_uid')
                ->unique('session_uid_unique');

            $table->enum('session_type', [
                'internal',
                'public',
            ]);

            $table->unsignedBigInteger(
                'session_samperin_user_id'
            )->nullable();

            $table->unsignedBigInteger(
                'session_guestbook_id'
            )->nullable();

            $table->string(
                'session_token',
                255
            )->unique('session_token_unique');

            $table->timestamp(
                'session_expires_at'
            );

            $table->string(
                'session_ip_address',
                45
            )->nullable();

            $table->text(
                'session_user_agent'
            )->nullable();

            $table->timestamp(
                'session_created_at'
            )->useCurrent();

            $table->timestamp(
                'session_updated_at'
            )->nullable();

            $table->index(
                'session_samperin_user_id',
                'session_user_idx'
            );

            $table->index(
                'session_guestbook_id',
                'session_guest_idx'
            );

            $table->index(
                'session_expires_at',
                'session_expires_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_session');
    }
};