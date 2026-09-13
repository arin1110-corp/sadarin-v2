<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_otp', function (Blueprint $table) {
            $table->id('otp_id');

            $table->uuid('otp_uid')
                ->unique('otp_uid_unique');

            $table->string(
                'otp_identifier',
                255
            );

            $table->enum('otp_type', [
                'internal',
                'public',
            ]);

            $table->string(
                'otp_code_hash',
                255
            );

            $table->timestamp('otp_expires_at');

            $table->timestamp(
                'otp_verified_at'
            )->nullable();

            $table->timestamp(
                'otp_last_attempt_at'
            )->nullable();

            $table->unsignedTinyInteger(
                'otp_attempt_count'
            )->default(0);

            $table->string(
                'otp_ip_address',
                45
            )->nullable();

            $table->text(
                'otp_user_agent'
            )->nullable();

            $table->timestamp('otp_created_at')->useCurrent();
            $table->timestamp('otp_updated_at')->nullable();

            $table->index(
                [
                    'otp_identifier',
                    'otp_type',
                ],
                'otp_identifier_type_idx'
            );

            $table->index(
                'otp_expires_at',
                'otp_expires_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_otp');
    }
};