<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_archive', function (Blueprint $table) {
            $table->id('archive_id');

            $table->uuid('archive_uid')
                ->unique('archive_uid_unique');

            $table->string('archive_title', 255);

            $table->text('archive_description')->nullable();

            $table->unsignedBigInteger(
                'archive_document_type_id'
            )->nullable();

            $table->date('archive_date')->nullable();

            $table->unsignedSmallInteger(
                'archive_year'
            )->nullable();

            $table->enum('archive_access_level', [
                'public',
                'internal',
                'restricted',
            ])->default('internal');

            $table->enum('archive_status', [
                'draft',
                'pending',
                'verified',
                'rejected',
            ])->default('draft');

            $table->unsignedBigInteger(
                'archive_created_by'
            )->nullable();

            $table->unsignedBigInteger(
                'archive_updated_by'
            )->nullable();

            $table->timestamp('archive_created_at')->useCurrent();
            $table->timestamp('archive_updated_at')->nullable();
            $table->timestamp('archive_deleted_at')->nullable();

            $table->index(
                'archive_document_type_id',
                'archive_doc_type_idx'
            );

            $table->index(
                'archive_access_level',
                'archive_access_idx'
            );

            $table->index(
                'archive_status',
                'archive_status_idx'
            );

            $table->index(
                'archive_year',
                'archive_year_idx'
            );

            $table->index(
                'archive_created_by',
                'archive_created_by_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive');
    }
};