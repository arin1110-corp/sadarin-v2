<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_user_role', function (Blueprint $table) {
            $table->id('user_role_id');

            $table->unsignedBigInteger(
                'user_role_samperin_user_id'
            );

            $table->unsignedBigInteger(
                'user_role_role_id'
            );

            $table->timestamp('user_role_created_at')->useCurrent();
            $table->timestamp('user_role_updated_at')->nullable();

            $table->unique(
                [
                    'user_role_samperin_user_id',
                    'user_role_role_id',
                ],
                'user_role_unique'
            );

            $table->index(
                'user_role_samperin_user_id',
                'user_role_user_idx'
            );

            $table->index(
                'user_role_role_id',
                'user_role_role_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_user_role');
    }
};