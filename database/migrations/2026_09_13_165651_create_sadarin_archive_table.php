<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_archive', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | PRIMARY KEY
            |--------------------------------------------------------------------------
            */
            $table->id('archive_id');


            /*
            |--------------------------------------------------------------------------
            | IDENTITAS ARSIP
            |--------------------------------------------------------------------------
            */
            $table->uuid('archive_uid')
                ->unique('arch_uid_uq');

            $table->string(
                'archive_title',
                255
            );

            $table->text(
                'archive_description'
            )->nullable();


            /*
            |--------------------------------------------------------------------------
            | KLASIFIKASI
            |--------------------------------------------------------------------------
            |
            | Unit
            |   ├── Bidang
            |   └── UPTD
            |
            | Program
            |   └── Kegiatan
            |         └── Sub Kegiatan
            |
            | Jenis Dokumen
            |
            */
            $table->unsignedBigInteger(
                'archive_unit_id'
            )->nullable();

            $table->unsignedBigInteger(
                'archive_program_id'
            )->nullable();

            $table->unsignedBigInteger(
                'archive_kegiatan_id'
            )->nullable();

            $table->unsignedBigInteger(
                'archive_sub_kegiatan_id'
            )->nullable();

            $table->unsignedBigInteger(
                'archive_document_type_id'
            )->nullable();


            /*
            |--------------------------------------------------------------------------
            | INFORMASI ARSIP
            |--------------------------------------------------------------------------
            */
            $table->date(
                'archive_date'
            )->nullable();

            $table->unsignedSmallInteger(
                'archive_year'
            )->nullable();


            /*
            |--------------------------------------------------------------------------
            | HAK AKSES
            |--------------------------------------------------------------------------
            */
            $table->enum('archive_access_level', [
                'public',
                'internal',
                'restricted',
            ])->default('internal');


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->enum('archive_status', [
                'draft',
                'pending',
                'verified',
                'rejected',
            ])->default('draft');


            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */
            $table->unsignedBigInteger(
                'archive_created_by'
            )->nullable();

            $table->unsignedBigInteger(
                'archive_updated_by'
            )->nullable();


            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */
            $table->timestamp(
                'archive_created_at'
            )->useCurrent();

            $table->timestamp(
                'archive_updated_at'
            )->nullable();

            $table->timestamp(
                'archive_deleted_at'
            )->nullable();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index(
                'archive_unit_id',
                'arch_unit_idx'
            );

            $table->index(
                'archive_program_id',
                'arch_prog_idx'
            );

            $table->index(
                'archive_kegiatan_id',
                'arch_keg_idx'
            );

            $table->index(
                'archive_sub_kegiatan_id',
                'arch_sub_keg_idx'
            );

            $table->index(
                'archive_document_type_id',
                'arch_doc_idx'
            );

            $table->index(
                'archive_access_level',
                'arch_access_idx'
            );

            $table->index(
                'archive_status',
                'arch_status_idx'
            );

            $table->index(
                'archive_year',
                'arch_year_idx'
            );

            $table->index(
                'archive_created_by',
                'arch_creator_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive');
    }
};