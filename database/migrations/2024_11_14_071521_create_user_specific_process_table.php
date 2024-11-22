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
        Schema::create('user_specific_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('date');
            $table->integer('quantity');
            $table->text('description');

            // Foreigh Keys
            $table->foreign('process_id')->references('process_id')->on('processes')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_specific_process', function (Blueprint $table) {
            $table->dropForeign(['process_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_specific_process');
    }
};
