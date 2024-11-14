<?php

use App\Http\Controllers\API\DepartmentController as APIDepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/department/all', [APIDepartmentController::class, 'getAllDepartments'])->name('departments.index');
