<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/API/departments.php';
require __DIR__ . '/API/employees.php';
require __DIR__ . '/API/measurements.php';
require __DIR__ . '/API/permissions.php';
require __DIR__ . '/API/processes.php';
require __DIR__ . '/API/roles.php';
require __DIR__ . '/API/backups.php';
require __DIR__ . '/API/reports.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/employee', function (Request $request) {
    return $request->user();
});