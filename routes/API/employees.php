<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeProcessController;
use App\Http\Controllers\API\EmployeeSpecificProcessController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/employees',                    [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/json',               [EmployeeController::class, 'json'])->name('employees.json');
    Route::put('/employee/create',              [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employee/update',              [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/employee/delete/{id}',         [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employee/active',              [EmployeeController::class, 'getActiveEmployees'])->name('employees.getActiveEmployees');
    Route::get('/employee/{id}',                [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employee/{employee}/processes', [EmployeeController::class, 'getActiveEmployeeProcesses'])->name('employees.getActiveEmployeeProcesses');

    // Маршруты для управления процессами сотрудников
    Route::put('/employee/{employee}/process/{process}/assign', [EmployeeProcessController::class, 'assignProcess'])->name('employees.assignProcess');
    Route::put('/employees/{employee}/process/{process}/unassign', [EmployeeProcessController::class, 'unassignProcess'])->name('employees.unassignProcess');

    // Маршруты для управления специфическими процессами сотрудников
    Route::put('/employee/{employee}/specific-process/{process}/assign', [EmployeeSpecificProcessController::class, 'assignSpecificProcess'])->name('employees.assignSpecificProcess');
    Route::put('/employee/{employee}/specific-process/{process}/unassign', [EmployeeSpecificProcessController::class, 'unassignSpecificProcess'])->name('employees.unassignSpecificProcess');
});
