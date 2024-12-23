<?php

use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/backup/create', [BackupController::class, 'create']);
    Route::get('/backup/list', [BackupController::class, 'list']);
    Route::post('/backup/restore/{filename}', [BackupController::class, 'restore']);
    Route::delete('/backup/delete/{filename}', [BackupController::class, 'delete']);
});
