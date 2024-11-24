<?php

require __DIR__ . '/auth.php';
require __DIR__ . '/API/departments.php';
require __DIR__ . '/API/employees.php';
require __DIR__ . '/API/measurements.php';
require __DIR__ . '/API/permissions.php';
require __DIR__ . '/API/processes.php';
require __DIR__ . '/API/roles.php';

use App\Http\Controllers\API\CheckCsrfTokenController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware('auth:sanctum')->get('/employee', function (Request $request) {
//     return $request->user();
// });

// Route::post('/sanctum/token', [AuthEmployeeController::class, 'token']);

// Route::get('/sanctum/check', [AuthEmployeeController::class, 'check']);

// Route::middleware('auth:sanctum')->get('/employee', function (Request $request): mixed {
//     return $request->user();
// });

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);

//     return ['token' => $token->plainTextToken];
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:sanctum')->get('/employee', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile',                  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',                [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',               [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reports',                  [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/employee',         [ReportController::class, 'employeeReport'])->name('reports.employee');
    Route::get('/reports/department',       [ReportController::class, 'departmentReport'])->name('reports.department');
    Route::get('/reports/library',          [ReportController::class, 'libraryReport'])->name('reports.library');
    Route::get('/dashboard',                [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::get('/dashboard/roles',          [DashboardController::class, 'roles'])->name('dashboard.roles');
    Route::get('/dashboard/departments',    [DashboardController::class, 'departments'])->name('dashboard.departments');
    Route::get('/dashboard/processes',      [DashboardController::class, 'processes'])->name('dashboard.processes');
    Route::get('/dashboard/measurements',   [DashboardController::class, 'measurements'])->name('dashboard.measurements');
    Route::get('/dashboard/employees',      [DashboardController::class, 'employees'])->name('dashboard.employees');
    Route::get('/dashboard/permissions',    [DashboardController::class, 'permissions'])->name('dashboard.permissions');

    Route::get('/check-csrf-token', [CheckCsrfTokenController::class, 'checkCsrfToken']);
});
