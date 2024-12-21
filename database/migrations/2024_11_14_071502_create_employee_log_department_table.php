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
        Schema::create('employee_log_department', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();

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
        Schema::table('employee_log_department', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('employee_log_department');
    }
};
