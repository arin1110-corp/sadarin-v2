<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_kegiatan', function (Blueprint $table) {
            $table->id('kegiatan_id');

            $table->uuid('kegiatan_uid')
                ->unique('keg_uid_uq');

            $table->unsignedBigInteger(
                'kegiatan_program_id'
            );

            $table->string(
                'kegiatan_code',
                100
            )->nullable();

            $table->string(
                'kegiatan_name',
                255
            );

            $table->text(
                'kegiatan_description'
            )->nullable();

            $table->boolean(
                'kegiatan_is_active'
            )->default(true);

            $table->timestamp(
                'kegiatan_created_at'
            )->useCurrent();

            $table->timestamp(
                'kegiatan_updated_at'
            )->nullable();

            $table->unique(
                'kegiatan_code',
                'keg_code_uq'
            );

            $table->unique(
                [
                    'kegiatan_program_id',
                    'kegiatan_name',
                ],
                'keg_prog_name_uq'
            );

            $table->index(
                'kegiatan_program_id',
                'keg_prog_idx'
            );

            $table->index(
                'kegiatan_is_active',
                'keg_active_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_kegiatan');
    }
};