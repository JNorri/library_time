<?php

use App\Http\Controllers\API\ProcessController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/processes',            [ProcessController::class, 'index'])->name('processes.index');
    Route::get('/processes/json',       [ProcessController::class, 'json'])->name('processes.json');
    Route::put('/process/create',       [ProcessController::class, 'store'])->name('processes.store');
    Route::put('/process/update/{id}',  [ProcessController::class, 'update'])->name('processes.update');
    Route::get('/process/delete/{id}',  [ProcessController::class, 'destroy'])->name('processes.destroy');
    Route::get('/process/{id}',         [ProcessController::class, 'show'])->name('processes.show');
});
