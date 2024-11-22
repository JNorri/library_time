<?php

use App\Http\Controllers\API\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/employees',                [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/json',           [EmployeeController::class, 'json'])->name('employees.json');
    Route::put('/employee/create',          [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employee/update',          [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/employee/delete/{id}',     [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employee/{id}',            [EmployeeController::class, 'show'])->name('employees.show');
});
