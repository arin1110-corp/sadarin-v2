<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_guestbook', function (Blueprint $table) {
            $table->id('guestbook_id');

            $table->uuid('guestbook_uid')
                ->unique('guestbook_uid_unique');

            $table->string(
                'guestbook_name',
                150
            );

            $table->string(
                'guestbook_email',
                255
            );

            $table->string(
                'guestbook_organization',
                255
            )->nullable();

            $table->string(
                'guestbook_phone',
                30
            )->nullable();

            $table->text('guestbook_purpose');

            $table->timestamp(
                'guestbook_created_at'
            )->useCurrent();

            $table->timestamp(
                'guestbook_updated_at'
            )->nullable();

            $table->index(
                'guestbook_email',
                'guestbook_email_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_guestbook');
    }
};