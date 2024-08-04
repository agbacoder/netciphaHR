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
        Schema::create('auth', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('employee_id')->unique();
            $table->string('password');
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained(
                      table: 'employees', column: 'user_id', indexName: 'auth_user_id'
            )->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth');
        Schema::dropIfExists('password_reset_tokens');

    }
};
