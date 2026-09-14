<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_program', function (Blueprint $table) {
            $table->id('program_id');

            $table->uuid('program_uid')
                ->unique('prog_uid_uq');

            $table->string('program_code', 100)
                ->nullable();

            $table->string('program_name', 255);

            $table->text('program_description')
                ->nullable();

            $table->boolean('program_is_active')
                ->default(true);

            $table->timestamp('program_created_at')
                ->useCurrent();

            $table->timestamp('program_updated_at')
                ->nullable();

            $table->unique(
                'program_code',
                'prog_code_uq'
            );

            $table->unique(
                'program_name',
                'prog_name_uq'
            );

            $table->index(
                'program_is_active',
                'prog_active_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_program');
    }
};