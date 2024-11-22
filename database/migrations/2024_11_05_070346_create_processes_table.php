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
            $table->id('process_id');
            $table->text('process_name');
            $table->unsignedBigInteger('measurement_id')->nullable();
            $table->boolean('is_daily')->default(true);
            $table->boolean('require_description')->default(false);
            $table->unsignedBigInteger('department_id');
            $table->decimal('process_duration', 5, 3)->default(60);

            // Foreign Keys
            $table->foreign('measurement_id')->references('measurement_id')->on('measurements')->onDelete('cascade');
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->dropForeign(['measurement_id']);
            $table->dropForeign(['department_id']);
        });

        Schema::dropIfExists('processes');
    }
};
