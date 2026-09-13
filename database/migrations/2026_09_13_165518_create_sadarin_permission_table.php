<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_permission', function (Blueprint $table) {
            $table->id('permission_id');

            $table->uuid('permission_uid')
                ->unique('permission_uid_unique');

            $table->string('permission_name', 100);
            $table->string('permission_label', 150);
            $table->text('permission_description')->nullable();

            $table->boolean('permission_is_active')->default(true);

            $table->timestamp('permission_created_at')->useCurrent();
            $table->timestamp('permission_updated_at')->nullable();

            $table->unique(
                'permission_name',
                'permission_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_permission');
    }
};