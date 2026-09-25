<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_archive_tag', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | ARCHIVE
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('archive_id');


            /*
            |--------------------------------------------------------------------------
            | TAG
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('tag_id');


            /*
            |--------------------------------------------------------------------------
            | CREATED AT
            |--------------------------------------------------------------------------
            */

            $table->timestamp('archive_tag_created_at')
                ->useCurrent();


            /*
            |--------------------------------------------------------------------------
            | PRIMARY KEY
            |--------------------------------------------------------------------------
            |
            | Satu archive tidak boleh memiliki tag yang sama dua kali.
            |
            */

            $table->primary(
                ['archive_id', 'tag_id'],
                'archive_tag_primary'
            );


            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEY ARCHIVE
            |--------------------------------------------------------------------------
            */

            $table->foreign('archive_id')
                ->references('archive_id')
                ->on('sadarin_archive')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEY TAG
            |--------------------------------------------------------------------------
            */

            $table->foreign('tag_id')
                ->references('tag_id')
                ->on('sadarin_tag')
                ->cascadeOnDelete();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sadarin_archive_tag');
    }
};