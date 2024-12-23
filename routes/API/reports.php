<?php

use App\Http\Controllers\API\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    // Route::get('/report/employee/{employeeId}/{startDate}/{endDate}',     [ReportController::class, 'generateEmployeeReportWeb'])->name('reports.employee');
    Route::get('/report/employee/{employeeId}/{startDate}/{endDate}', [ReportController::class, 'showEmployeeReportApi']);
    Route::get('/report/department/{departmentId}/{startDate}/{endDate}', [ReportController::class, 'generateDepartmentReportApi']);
    Route::get('/report/department',   [ReportController::class, 'showDepartmentReportForm'])->name('reports.departments');
    Route::get('/report/library',       [ReportController::class, 'showLibraryReportForm'])->name('reports.library');
    Route::get('/report/employee', [ReportController::class, 'showEmployeeReportForm'])->name('reports.employees');
    Route::get('/departments/{departmentId}/employees', [ReportController::class, 'getEmployeesByDepartment']);
    Route::get('/report/department/{departmentId}', [ReportController::class, 'showDepartmentReport']);
    Route::get('/report/employee/{employeeId}', [ReportController::class, 'showEmployeeReportApiWEB']);
    
    Route::get('/report/employees-by-department/{departmentId}', [ReportController::class, 'getEmployeesByDepartment']);
    // Route::get('/report/science-library', [ReportController::class, 'showScienceLibraryReportApi']);
    Route::get('/report/science-library/{startDate}/{endDate}', [ReportController::class, 'libraryReportApi']);
    
    
    // Route::get('/report/employee/{employeeId}/{startDate}/{endDate}', [ReportController::class, 'generateEmployeeReport'])->name('reports.employee');
});
