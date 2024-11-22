<?php

use App\Http\Controllers\API\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/json', [PermissionController::class, 'json'])->name('permissions.json');
    Route::put('/permission/create', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permission/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permission/{id}', [PermissionController::class, 'show'])->name('permissions.show');
});
