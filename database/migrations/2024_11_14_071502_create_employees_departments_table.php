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
        Schema::create('employees_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();

            // Foreigh Keys
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('restrict');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees_departments', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('employees_departments');
    }
};
