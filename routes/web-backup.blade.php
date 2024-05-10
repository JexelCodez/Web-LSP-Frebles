<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


// Root goes to landingpage
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// Shop Page
Route::get('shop', [HomeController::class, 'showShop'])->name('landingpage-items.shop');

// Product Details Page
Route::get('product-details', [HomeController::class, 'showProductDetails'])->name('landingpage-items.product-details');

// Contact Page
Route::get('contact', [HomeController::class, 'showContact'])->name('landingpage-items.contact');

// Dashboard for owner
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Built-in from Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Path
Route::get('admin/dashboard', [HomeController::class, 'showAdminDashboard'])->middleware(['auth', 'admin']);

// User Path
Route::get('user/dashboard', [HomeController::class, 'showUserDashboard'])->middleware(['auth', 'user'])->name('user.dashboard');

// RESOURCEFULL ROUTES

    // Discount Categories
    Route::resource('discount-categories', App\Http\Controllers\DiscountCategoriesController::class)->middleware(['auth', 'admin']);

    // Discounts
    Route::resource('discounts', App\Http\Controllers\DiscountController::class)->middleware(['auth', 'admin']);

    // Product Categories
    Route::resource('product-categories', App\Http\Controllers\ProductCategoriesController::class)->middleware(['auth', 'admin']);

    // Products
    Route::resource('products', App\Http\Controllers\ProductController::class)->middleware(['auth', 'admin']);

    // Orders
    Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware(['auth', 'user']);

    // Order Details (like a bill)
    // Route::resource('order-details', App\Http\Controllers\OrdersController::class);

    // Deliveries
    Route::resource('deliveries', App\Http\Controllers\DeliveriesController::class)->middleware(['auth', 'admin']);

    // Payments
    Route::resource('payments', App\Http\Controllers\PaymentController::class)->middleware(['auth', 'admin', 'user']);

    // Wishlists
    Route::resource('wishlists', App\Http\Controllers\WishlistController::class)->middleware(['auth', 'user']);

    // Product Reviews
    Route::resource('product-reviews', App\Http\Controllers\ProductReviewsController::class)->middleware(['auth', 'user']);

    // Customers (nanti request-only email sama password aja, terus dia kan rolenya default user, pake custom login logic)
    Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware(['auth', 'admin']);

    // Users
    // Route::resource('users', App\Http\Controllers\ProductReviewsController::class);