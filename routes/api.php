<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;


Route::get('/medicines', [MedicineController::class, 'apiIndex']);
Route::get('/medicines/{id}', [MedicineController::class, 'apiShow']);
Route::post('/medicines', [MedicineController::class, 'apiStore']);
Route::put('/medicines/{id}', [MedicineController::class, 'apiUpdate']);
Route::delete('/medicines/{id}', [MedicineController::class, 'apiDelete']);

