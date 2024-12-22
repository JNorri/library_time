<?php

use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/roles',            [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/json',       [RoleController::class, 'json'])->name('roles.json');
    Route::put('/role/create',      [RoleController::class, 'store'])->name('roles.store');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/role/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/role/{id}',        [RoleController::class, 'show'])->name('roles.show');
    // Назначение разрешения роли
    Route::post('/roles/{role}/permissions/{permission}', [RolePermissionController::class, 'assignPermissionToRole']);

    // Снятие разрешения с роли
    Route::delete('/roles/{role}/permissions/{permission}', [RolePermissionController::class, 'unassignPermissionFromRole']);

    // Получение всех разрешений роли
    Route::get('/roles/{role}/permissions', [RolePermissionController::class, 'getRolePermissions']);

    // Назначение нескольких разрешений роли
    Route::post('/roles/{role}/permissions', [RolePermissionController::class, 'assignMultiplePermissionsToRole']);

    // Снятие нескольких разрешений с роли
    Route::delete('/roles/{role}/permissions', [RolePermissionController::class, 'unassignMultiplePermissionsFromRole']);
});
