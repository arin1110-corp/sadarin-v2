<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_archive_file', function (Blueprint $table) {
            $table->id('archive_file_id');

            $table->uuid('archive_file_uid')
                ->unique('archive_file_uid_unique');

            $table->unsignedBigInteger(
                'archive_file_archive_id'
            );

            $table->string(
                'archive_file_original_name',
                255
            );

            $table->string(
                'archive_file_stored_name',
                255
            )->nullable();

            $table->string(
                'archive_file_extension',
                20
            )->nullable();

            $table->string(
                'archive_file_mime_type',
                150
            )->nullable();

            $table->unsignedBigInteger(
                'archive_file_size'
            )->nullable();

            $table->string(
                'archive_file_drive_file_id',
                255
            );

            $table->text(
                'archive_file_drive_url'
            )->nullable();

            $table->boolean(
                'archive_file_is_primary'
            )->default(false);

            $table->timestamp(
                'archive_file_created_at'
            )->useCurrent();

            $table->timestamp(
                'archive_file_updated_at'
            )->nullable();

            $table->timestamp(
                'archive_file_deleted_at'
            )->nullable();

            $table->index(
                'archive_file_archive_id',
                'archive_file_archive_idx'
            );

            $table->index(
                'archive_file_drive_file_id',
                'archive_file_drive_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive_file');
    }
};