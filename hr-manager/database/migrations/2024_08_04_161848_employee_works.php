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
            $table->string('hire_date')->nullable();
            $table->string('start_date')->nullable();
            $table->string('pay_rate')->nullable();
            $table->string('overtime')->nullable();
            $table->string('employee_status')->nullable();

            $table->foreignId('access_level_id')->constrained(
                table: 'access', column: 'access_level_id', indexName: 'employee_works_access_level_id'
            )->onDelete('cascade');

            $table->foreignUuid('user_id')->constrained(
                table: 'employees', column: 'user_id', indexName: 'employee_works_user_id'
            )->onDelete('cascade');

            $table->foreignId('department_id')->constrained(
                table: 'departments', column: 'department_id', indexName: 'employee_works_department_id'
            )->nullable()->onDelete('cascade');

            $table->foreignId('designation_id')->constrained(
                table: 'designations', column: 'designation_id', indexName: 'employee_works_designation_id'
            )->nullable()->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('employee_benefits', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained(
                table: 'employees', column: 'user_id', indexName: 'employee_benefits_user_id'
            )->onDelete('cascade');
        });

        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration');
            $table->string('description');
            $table->string('status');

            $table->foreignUuid('user_id')->constrained(
                table: 'employees', column: 'user_id', indexName: 'employee_leaves_user_id'
            )->onDelete('cascade');
        });

        Schema::create('employee_emergency', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('relation_type')->nullable();
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained(
                table: 'employees', column: 'user_id', indexName: 'employee_emergency_user_id'
            )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_works');
        Schema::dropIfExists('employee_benefits');
        Schema::dropIfExists('employee_leaves');
        Schema::dropIfExists('employee_emergency');
    }
};
