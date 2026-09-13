<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_tag', function (Blueprint $table) {
            $table->id('tag_id');

            $table->uuid('tag_uid')
                ->unique('tag_uid_unique');

            $table->string('tag_name', 100);
            $table->string('tag_slug', 120);

            $table->text('tag_description')->nullable();

            $table->boolean('tag_is_active')->default(true);

            $table->timestamp('tag_created_at')->useCurrent();
            $table->timestamp('tag_updated_at')->nullable();

            $table->unique('tag_name', 'tag_name_unique');
            $table->unique('tag_slug', 'tag_slug_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_tag');
    }
};