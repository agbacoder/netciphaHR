<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id('doc_id');
            $table->foreignUuid('user_id')->constrained(
                table: 'employees', column: 'user_id', indexName: 'documents_user_id'
          )->onDelete('cascade');
            $table->string('doc_name');
            $table->string('doc_address');
            $table->timestamps();
            $table->foreignId('folder_id')->constrained(
                 table: 'folders', column: 'folder_id', indexName: 'documents_folder_id'
            )->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
