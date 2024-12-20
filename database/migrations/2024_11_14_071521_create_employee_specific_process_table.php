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
        Schema::create('employee_specific_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamp('date');
            $table->integer('quantity');
            $table->text('description')->nullable();

            // Foreigh Keys
            $table->foreign('process_id')->references('process_id')->on('processes')->onDelete('restrict');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_specific_process', function (Blueprint $table) {
            $table->dropForeign(['process_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('employee_specific_process');
    }
};
