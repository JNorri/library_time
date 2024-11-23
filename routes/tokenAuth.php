<?php

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

// Маршрут для получения токена (POST)
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $employee = Employee::where('email', $request->email)->first();


    if (! $employee || ! Hash::check($request->password, $employee->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $employee->createToken($request->device_name)->plainTextToken;
});

// Маршрут для проверки токена (GET)
Route::get('/sanctum/check', function (Request $request) {
    if (auth('sanctum')->check()) {
        return "ValidToken";
    } else {
        return "InValidToken";
    }
});
