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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->text('process_name');
            $table->unsignedBigInteger('measurement_id')->nullable();
            $table->float('time_in_hours')->nullable();
            $table->boolean('process_is_daily');
            $table->boolean('requires_description')->default(false);
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('sector_id')->nullable();

            // Foreign Key
            $table->foreign('measurement_id')->references('id')->on('measurements');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('sector_id')->references('id')->on('sectors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
