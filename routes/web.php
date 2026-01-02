<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Your Existing Project)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [PageController::class, 'home'])->name('home');

// Departments (dynamic)
Route::get('/departments', [DepartmentController::class, 'showAllFrontend'])->name('departments');

// Medicines (dynamic)
Route::get('/medicines', [MedicineController::class, 'showAllFrontend'])->name('medicines');

// Medicine Detail (dynamic)
Route::get('/medicinedetail/{id}', [MedicineController::class, 'showFrontend'])->name('medicinedetail');

// Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Authentication
// Frontend User Login/Register (static forms for now)
Route::get('/user-login', [PageController::class, 'login'])->name('user.login');
Route::get('/user-register', [PageController::class, 'register'])->name('user.register');


// Cart
Route::get('/cart', [PageController::class, 'cart'])->name('cart');

// Checkout
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');

// Thank You
Route::get('/thankyou', [PageController::class, 'thankyou'])->name('thankyou');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES (CRUD)
|--------------------------------------------------------------------------
*/
// Breeze Default Dashboard (required for login redirect)
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->get('/profile', function () {
    return view('profile.edit'); 
})->name('profile.edit');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
Route::resource('medicines', MedicineController::class);
Route::resource('departments', DepartmentController::class);

});
Route::get('/ajax/medicines/search', [MedicineController::class, 'search'])->name('ajax.medicines.search');

Route::get('/ajax/departments/search', 
    [DepartmentController::class, 'search']
)->name('ajax.departments.search');

// Add a review for a medicine
Route::post('/medicines/{medicine}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Delete a review
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Place Order
Route::post('/place_order', [OrderController::class, 'store'])
     ->name('order.store');

     // Order History
Route::get('/order_history', [OrderController::class, 'history'])
     ->name('order.history');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
