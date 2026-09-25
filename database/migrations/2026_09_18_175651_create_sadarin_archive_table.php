<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sadarin_archive', function (Blueprint $table) {
            $table->id('archive_id');

            $table->uuid('archive_uid')->unique('archive_uid_unique');

            /*
            |--------------------------------------------------------------------------
            | PEMILIK / PENGAJU ARSIP
            |--------------------------------------------------------------------------
            |
            | ID user berasal dari SAMPERIN.
            | SADARIN tidak menyimpan tabel user sendiri.
            |
            */

            $table->unsignedBigInteger('archive_user_id')->nullable();

            /*
            |--------------------------------------------------------------------------
            | MASTER ARSIP
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('archive_unit_id')->nullable();

            $table->unsignedBigInteger('archive_sub_kegiatan_id')->nullable();

            $table->unsignedBigInteger('archive_document_type_id')->nullable();

            /*
            |--------------------------------------------------------------------------
            | INFORMASI ARSIP
            |--------------------------------------------------------------------------
            */

            $table->string('archive_title', 255);

            $table->text('archive_description')->nullable();

            $table->year('archive_year')->nullable();

            /*
            |--------------------------------------------------------------------------
            | LINK GOOGLE DRIVE
            |--------------------------------------------------------------------------
            |
            | Tidak ada archive_file lagi.
            | Satu archive langsung memiliki satu link sumber.
            |
            */

            $table->text('archive_drive_url')->nullable();

            $table->string('archive_drive_folder_id', 255)->nullable();

            /*
            |--------------------------------------------------------------------------
            | AKSES
            |--------------------------------------------------------------------------
            */

            $table->enum('archive_access_level', ['public', 'internal'])->default('internal');

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('archive_status', ['draft', 'pending', 'verified', 'rejected'])->default('draft');

            $table->text('archive_rejection_reason')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */

            $table->timestamp('archive_created_at')->useCurrent();

            $table->timestamp('archive_updated_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('archive_user_id', 'archive_user_id_index');

            $table->index('archive_unit_id', 'archive_unit_id_index');

            $table->index('archive_sub_kegiatan_id', 'archive_sub_kegiatan_id_index');

            $table->index('archive_document_type_id', 'archive_document_type_id_index');

            $table->index('archive_status', 'archive_status_index');

            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEY
            |--------------------------------------------------------------------------
            */

            $table->foreign('archive_unit_id')->references('unit_id')->on('sadarin_unit')->nullOnDelete();

            $table->foreign('archive_sub_kegiatan_id')->references('sub_kegiatan_id')->on('sadarin_sub_kegiatan')->nullOnDelete();

            $table->foreign('archive_document_type_id')->references('document_type_id')->on('sadarin_document_type')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive');
    }
};