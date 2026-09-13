<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_survey_response', function (Blueprint $table) {
            $table->id('survey_response_id');

            $table->uuid('survey_response_uid')
                ->unique('survey_response_uid_unique');

            $table->unsignedBigInteger(
                'survey_response_survey_id'
            );

            $table->unsignedBigInteger(
                'survey_response_guestbook_id'
            )->nullable();

            $table->unsignedBigInteger(
                'survey_response_samperin_user_id'
            )->nullable();

            $table->unsignedTinyInteger(
                'survey_response_rating'
            )->nullable();

            $table->text(
                'survey_response_message'
            )->nullable();

            $table->timestamp(
                'survey_response_created_at'
            )->useCurrent();

            $table->timestamp(
                'survey_response_updated_at'
            )->nullable();

            $table->index(
                'survey_response_survey_id',
                'survey_response_survey_idx'
            );

            $table->index(
                'survey_response_guestbook_id',
                'survey_response_guest_idx'
            );

            $table->index(
                'survey_response_samperin_user_id',
                'survey_response_user_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_survey_response');
    }
};