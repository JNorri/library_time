<?php

use App\Http\Controllers\API\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/report/employee',     [ReportController::class, 'getEmployeeReport'])->name('reports.employees');
    Route::get('/report/department',   [ReportController::class, 'getDepartmentReport'])->name('reports.departments');
    Route::get('/report/library',      [ReportController::class, 'getLibraryReport'])->name('reports.libraries');
});
