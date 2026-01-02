<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MedicineController;

// 1. PUBLIC LOGIN ROUTE
Route::post('/login', [AuthController::class, 'login']);

// 2. PROTECTED MEDICINE ROUTES
Route::middleware('auth:api')->group(function () {
    Route::get('/medicines', [MedicineController::class, 'apiIndex']);
    Route::get('/medicines/{id}', [MedicineController::class, 'apiShow']);
    Route::post('/medicines', [MedicineController::class, 'apiStore']);
    Route::put('/medicines/{id}', [MedicineController::class, 'apiUpdate']);
    Route::delete('/medicines/{id}', [MedicineController::class, 'apiDelete']);
    
    // Logout from API
    Route::post('/logout', [AuthController::class, 'logout']);
});