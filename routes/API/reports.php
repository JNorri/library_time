<?php

use App\Http\Controllers\API\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/report/employee',     [ReportController::class, 'employeeReportJson']);
    Route::get('/report/department',   [ReportController::class, 'departmentReportJson']);
    Route::get('/report/library',      [ReportController::class, 'libraryReportJson']);
});
