<?php

use App\Http\Controllers\API\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/department/all',               [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/department/json',             [DepartmentController::class, 'json'])->name('departments.json');
    Route::put('/department/create',            [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('/department/update/{id}',       [DepartmentController::class, 'update'])->name('departments.update');
    Route::get('/department/delete/{id}',       [DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('/department/employees',         [DepartmentController::class, 'getDepartmentsWithEmployees'])->name('departments.getDepartmentsWithEmployees');
    Route::get('/department/{id}',              [DepartmentController::class, 'show'])->name('departments.show');
    Route::post('/department/assign-process',   [DepartmentController::class, 'assignProcess'])->name('departments.assignProcess');
});
