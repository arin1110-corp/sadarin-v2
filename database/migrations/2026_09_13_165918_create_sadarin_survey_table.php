<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_survey', function (Blueprint $table) {
            $table->id('survey_id');

            $table->uuid('survey_uid')
                ->unique('survey_uid_unique');

            $table->string(
                'survey_title',
                255
            );

            $table->text(
                'survey_description'
            )->nullable();

            $table->boolean(
                'survey_is_active'
            )->default(true);

            $table->timestamp(
                'survey_started_at'
            )->nullable();

            $table->timestamp(
                'survey_ended_at'
            )->nullable();

            $table->timestamp(
                'survey_created_at'
            )->useCurrent();

            $table->timestamp(
                'survey_updated_at'
            )->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_survey');
    }
};