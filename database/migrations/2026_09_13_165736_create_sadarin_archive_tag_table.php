<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_archive_tag', function (Blueprint $table) {
            $table->id('archive_tag_id');

            $table->unsignedBigInteger(
                'archive_tag_archive_id'
            );

            $table->unsignedBigInteger(
                'archive_tag_tag_id'
            );

            $table->timestamp(
                'archive_tag_created_at'
            )->useCurrent();

            $table->timestamp(
                'archive_tag_updated_at'
            )->nullable();

            $table->unique(
                [
                    'archive_tag_archive_id',
                    'archive_tag_tag_id',
                ],
                'archive_tag_unique'
            );

            $table->index(
                'archive_tag_archive_id',
                'archive_tag_archive_idx'
            );

            $table->index(
                'archive_tag_tag_id',
                'archive_tag_tag_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive_tag');
    }
};