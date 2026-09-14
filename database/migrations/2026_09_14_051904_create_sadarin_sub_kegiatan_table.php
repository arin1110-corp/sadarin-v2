<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_sub_kegiatan', function (Blueprint $table) {
            $table->id('sub_kegiatan_id');

            $table->uuid('sub_kegiatan_uid')
                ->unique('sub_keg_uid_uq');

            $table->unsignedBigInteger(
                'sub_kegiatan_kegiatan_id'
            );

            $table->string(
                'sub_kegiatan_code',
                100
            )->nullable();

            $table->string(
                'sub_kegiatan_name',
                255
            );

            $table->text(
                'sub_kegiatan_description'
            )->nullable();

            $table->boolean(
                'sub_kegiatan_is_active'
            )->default(true);

            $table->timestamp(
                'sub_kegiatan_created_at'
            )->useCurrent();

            $table->timestamp(
                'sub_kegiatan_updated_at'
            )->nullable();

            $table->unique(
                'sub_kegiatan_code',
                'sub_keg_code_uq'
            );

            $table->unique(
                [
                    'sub_kegiatan_kegiatan_id',
                    'sub_kegiatan_name',
                ],
                'sub_keg_keg_name_uq'
            );

            $table->index(
                'sub_kegiatan_kegiatan_id',
                'sub_keg_keg_idx'
            );

            $table->index(
                'sub_kegiatan_is_active',
                'sub_keg_active_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_sub_kegiatan');
    }
};