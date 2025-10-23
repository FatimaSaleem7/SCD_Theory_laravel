<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Home
Route::get('/', [PageController::class, 'home'])->name('home');

// Departments
Route::get('/departments', [PageController::class, 'departments'])->name('departments');

// Medicines
Route::get('/medicines', [PageController::class, 'medicines'])->name('medicines');

// Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Cart
Route::get('/cart', [PageController::class, 'cart'])->name('cart');

// Checkout
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');

// Authentication
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');
