<?php

use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/backup/all',      [BackupController::class, 'index'])->name('backups.index');
    Route::get('/backup/restore',  [BackupController::class, 'restore'])->name('backups.restore');
    Route::get('/backup/create',   [BackupController::class, 'create'])->name('backups.create');
});
