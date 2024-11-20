<?php

use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__ . '/auth.php';
Route::get('/department/all',           [DepartmentController::class, 'index'])->name('departments.index');
