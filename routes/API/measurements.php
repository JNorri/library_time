<?php

use App\Http\Controllers\API\MeasurementController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/measurements',             [MeasurementController::class, 'index'])->name('measurements.index');
    Route::get('/measurements/json',        [MeasurementController::class, 'json'])->name('measurements.json');
    Route::put('/measurement/create',       [MeasurementController::class, 'store'])->name('measurements.store');
    Route::put('/measurement/update/{id}',  [MeasurementController::class, 'update'])->name('measurements.update');
    Route::get('/measurement/delete/{id}',  [MeasurementController::class, 'destroy'])->name('measurements.destroy');
    Route::get('/measurement/{id}',         [MeasurementController::class, 'show'])->name('measurements.show');
});
