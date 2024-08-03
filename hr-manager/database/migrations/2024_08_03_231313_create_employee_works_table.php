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
        Schema::create('employee_works', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('hire_date');
            $table->string('start_date');
            $table->string('title');
            $table->string('uid');
            $table->string('pay_rate');
            $table->string('overtime');

            $table->foreignUuid('user_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_works');
    }
};
