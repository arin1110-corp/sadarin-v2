<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_role', function (Blueprint $table) {
            $table->id('role_id');

            $table->uuid('role_uid')->unique('role_uid_unique');

            $table->string('role_name', 100);
            $table->text('role_description')->nullable();

            $table->boolean('role_is_active')->default(true);

            $table->timestamp('role_created_at')->useCurrent();
            $table->timestamp('role_updated_at')->nullable();

            $table->unique('role_name', 'role_name_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_role');
    }
};