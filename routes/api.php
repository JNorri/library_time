<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DepartmentController as APIDepartmentController;
use App\Http\Controllers\API\EmployeeController as APIEmployeeController;
use App\Http\Controllers\API\MeasurementController as APIMeasurementController;
use App\Http\Controllers\API\ProcessController as APIProcessController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/department/all',           [APIDepartmentController::class, 'index'])->name('departments.index');
Route::put('/department/create',        [APIDepartmentController::class, 'store'])->name('departments.store');
Route::put('/department/update/{id}',   [APIDepartmentController::class, 'update'])->name('departments.update');
Route::get('/department/delete/{id}',   [APIDepartmentController::class, 'destroy'])->name('departments.destroy');
Route::get('/department/{id}',          [APIDepartmentController::class, 'show'])->name('departments.show');

Route::get('/employee/all',             [APIEmployeeController::class, 'index'])->name('employees.index');
Route::put('/employee/create',          [APIEmployeeController::class, 'store'])->name('employees.store');
Route::put('/employee/update/{id}',     [APIEmployeeController::class, 'update'])->name('employees.update');
Route::get('/employee/delete/{id}',     [APIEmployeeController::class, 'destroy'])->name('employees.destroy');
Route::get('/employee/{id}',            [APIEmployeeController::class, 'show'])->name('employees.show');

Route::get('/measurement/all',          [APIMeasurementController::class, 'index'])->name('measurements.index');
Route::put('/measurement/create',       [APIMeasurementController::class, 'store'])->name('measurements.store');
Route::put('/measurement/update/{id}',  [APIMeasurementController::class, 'update'])->name('measurements.update');
Route::get('/measurement/delete/{id}',  [APIMeasurementController::class, 'destroy'])->name('measurements.destroy');
Route::get('/measurement/{id}',         [APIMeasurementController::class, 'show'])->name('measurements.show');

Route::get('/process/all',              [APIProcessController::class, 'index'])->name('processes.index');
Route::put('/process/create',           [APIProcessController::class, 'store'])->name('processes.store');
Route::put('/process/update/{id}',      [APIProcessController::class, 'update'])->name('processes.update');
Route::get('/process/delete/{id}',      [APIProcessController::class, 'destroy'])->name('processes.destroy');
Route::get('/process/{id}',             [APIProcessController::class, 'show'])->name('processes.show');
