<?php

use App\Http\Controllers\API\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/roles',            [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/json',       [RoleController::class, 'json'])->name('roles.json');
    Route::put('/role/create',      [RoleController::class, 'store'])->name('roles.store');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/role/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/role/{id}',        [RoleController::class, 'show'])->name('roles.show');
});
