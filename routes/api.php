<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\MeasurementController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\ProcessController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\DashboardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard',                [DashboardController::class, 'index'])->middleware('auth');
    Route::get('/employees',                [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/json',           [EmployeeController::class, 'json'])->name('employees.json');

    Route::get('/measurements',             [MeasurementController::class, 'index'])->name('measurements.index');
    Route::get('/measurements/json',        [MeasurementController::class, 'json'])->name('measurements.json');

    Route::get('/processes',                [ProcessController::class, 'index'])->name('processes.index');
    Route::get('/processes/json',           [ProcessController::class, 'json'])->name('processes.json');

    Route::get('/departments',              [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/json',         [DepartmentController::class, 'json'])->name('departments.json');

    Route::get('/roles',                    [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/json',               [RoleController::class, 'json'])->name('roles.json');

    Route::get('/permissions',              [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/json',         [PermissionController::class, 'json'])->name('permissions.json');


    Route::get('/department/all',           [DepartmentController::class, 'index'])->name('departments.index');
    Route::put('/department/create',        [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('/department/update/{id}',   [DepartmentController::class, 'update'])->name('departments.update');
    Route::get('/department/delete/{id}',   [DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('/department/{id}',          [DepartmentController::class, 'show'])->name('departments.show');

    Route::get('/employee/all',             [EmployeeController::class, 'index'])->name('employees.index');
    Route::put('/employee/create',          [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employee/update/{id}',     [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/employee/delete/{id}',     [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employee/{id}',            [EmployeeController::class, 'show'])->name('employees.show');

    Route::get('/measurement/all',          [MeasurementController::class, 'index'])->name('measurements.index');
    Route::put('/measurement/create',       [MeasurementController::class, 'store'])->name('measurements.store');
    Route::put('/measurement/update/{id}',  [MeasurementController::class, 'update'])->name('measurements.update');
    Route::get('/measurement/delete/{id}',  [MeasurementController::class, 'destroy'])->name('measurements.destroy');
    Route::get('/measurement/{id}',         [MeasurementController::class, 'show'])->name('measurements.show');

    Route::get('/process/all',              [ProcessController::class, 'index'])->name('processes.index');
    Route::put('/process/create',           [ProcessController::class, 'store'])->name('processes.store');
    Route::put('/process/update/{id}',      [ProcessController::class, 'update'])->name('processes.update');
    Route::get('/process/delete/{id}',      [ProcessController::class, 'destroy'])->name('processes.destroy');
    Route::get('/process/{id}',             [ProcessController::class, 'show'])->name('processes.show');
});
