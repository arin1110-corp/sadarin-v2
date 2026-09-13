<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadarin_document_type', function (Blueprint $table) {
            $table->id('document_type_id');

            $table->uuid('document_type_uid')
                ->unique('doc_type_uid_unique');

            $table->string('document_type_name', 150);
            $table->text('document_type_description')->nullable();

            $table->boolean('document_type_is_active')->default(true);

            $table->timestamp('document_type_created_at')->useCurrent();
            $table->timestamp('document_type_updated_at')->nullable();

            $table->unique(
                'document_type_name',
                'doc_type_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadarin_document_type');
    }
};