<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('role_log_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('permission_id')->references('permission_id')->on('permissions');

            $table->primary(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_log_permission', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['permission_id']);
        });
        Schema::dropIfExists('role_log_permission');
    }
};
