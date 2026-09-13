<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_setting', function (Blueprint $table) {
            $table->id('setting_id');

            $table->uuid('setting_uid')
                ->unique('setting_uid_unique');

            $table->string(
                'setting_key',
                150
            );

            $table->text(
                'setting_value'
            )->nullable();

            $table->string(
                'setting_type',
                30
            )->default('string');

            $table->text(
                'setting_description'
            )->nullable();

            $table->timestamp(
                'setting_created_at'
            )->useCurrent();

            $table->timestamp(
                'setting_updated_at'
            )->nullable();

            $table->unique(
                'setting_key',
                'setting_key_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_setting');
    }
};