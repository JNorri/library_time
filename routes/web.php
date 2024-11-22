<?php

require __DIR__ . '/auth.php';

use App\Http\Controllers\API\CheckCsrfTokenController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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

    Route::get('/dashboard',                [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::get('/dashboard/roles',          [DashboardController::class, 'roles'])->name('dashboard.roles');
    Route::get('/dashboard/departments',    [DashboardController::class, 'departments'])->name('dashboard.departments');
    Route::get('/dashboard/processes',      [DashboardController::class, 'processes'])->name('dashboard.processes');
    Route::get('/dashboard/measurements',   [DashboardController::class, 'measurements'])->name('dashboard.measurements');
    Route::get('/dashboard/employees',      [DashboardController::class, 'employees'])->name('dashboard.employees');
    Route::get('/dashboard/permissions',    [DashboardController::class, 'permissions'])->name('dashboard.permissions');
});

Route::get('/department/all',           [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/check-csrf-token', [CheckCsrfTokenController::class, 'checkCsrfToken']);
