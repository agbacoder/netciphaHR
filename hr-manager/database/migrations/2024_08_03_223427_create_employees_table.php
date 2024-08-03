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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('D_O_B');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('address');
            $table->string('contact_1');
            $table->string('contact_2');
            $table->string('email')->unique();
            $table->string('social_1');
            $table->string('social_2');
            $table->string('education_level');
            $table->string('disability');

            $table->timestamps();

            $table->foreignUuid('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
