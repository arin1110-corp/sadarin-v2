<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sadarin_archive_file_tag', function (Blueprint $table) {
            $table->id('archive_file_tag_id');

            $table->unsignedBigInteger('archive_file_tag_archive_file_id');

            $table->unsignedBigInteger('archive_file_tag_tag_id');

            $table->timestamp('archive_file_tag_created_at')->useCurrent();

            $table->timestamp('archive_file_tag_updated_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('archive_file_tag_archive_file_id', 'archive_file_tag_file_idx');

            $table->index('archive_file_tag_tag_id', 'archive_file_tag_tag_idx');

            /*
            |--------------------------------------------------------------------------
            | UNIQUE
            |--------------------------------------------------------------------------
            |
            | Satu berkas tidak boleh memiliki tag yang sama dua kali.
            |
            */

            $table->unique(['archive_file_tag_archive_file_id', 'archive_file_tag_tag_id'], 'archive_file_tag_file_tag_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive_file_tag');
    }
};