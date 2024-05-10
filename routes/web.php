<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;

// Root goes to landingpage
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// Shop Page
Route::get('shop', [HomeController::class, 'showShop'])->name('landingpage-items.shop');

// Cart Page
Route::get('cart', [CartController::class, 'showCart'])->name('landingpage-items.cart')->middleware(['auth']);
Route::post('add_cart/{id}', [CartController::class, 'AddToCart'])->name('landingpage-items.add-to-cart');
Route::get('remove_cart/{id}', [CartController::class, 'removeCart'])->name('landingpage-items.remove-from-cart');

// Payment Form Page
Route::get('payment-form', [HomeController::class, 'showPaymentForm'])->name('landingpage-items.payment-form');
Route::get('cartOrder', [CartController::class, 'cartOrder']);

// Product Details Page
Route::get('product-details/{id}', [HomeController::class, 'showProductDetails'])->name('landingpage-items.product-details');

// Contact Page
Route::get('contact', [HomeController::class, 'showContact'])->name('landingpage-items.contact');

// Subscriber URL
Route::post('subscribe', [SubscriptionController::class, 'sendSubscription'])->middleware(['auth']);

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


// Admin Auth //

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin-specific routes
    Route::get('dashboard', [HomeController::class, 'showAdminDashboard']);

    // Discount Categories
    Route::resource('discount-categories', App\Http\Controllers\Admin\DiscountCategoriesController::class);

    // Discounts
    Route::resource('discounts', App\Http\Controllers\Admin\DiscountController::class);

    // Product Categories
    Route::resource('product-categories', App\Http\Controllers\Admin\ProductCategoriesController::class);

    // Products
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    // Orders
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);

    // Deliveries
    Route::resource('deliveries', App\Http\Controllers\Admin\DeliveriesController::class);

    // Payments
    Route::resource('payments', App\Http\Controllers\Admin\PaymentController::class);

    // Customers
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);
});


// User Auth

Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    // Admin-specific routes
    Route::get('dashboard', [HomeController::class, 'showUserDashboard']);

    // Orders
    Route::resource('orders', App\Http\Controllers\User\OrderController::class);

    // Payments
    Route::resource('payments', App\Http\Controllers\User\PaymentController::class);

    // Wishlists
    Route::resource('wishlists', App\Http\Controllers\User\WishlistController::class);

    // Product Reviews
    Route::resource('product-reviews', App\Http\Controllers\User\ProductReviewsController::class);

    // Customers
    Route::get('customers/create', [App\Http\Controllers\User\CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers', [App\Http\Controllers\User\CustomerController::class, 'store'])->name('customers.store');
    
    
    // Route::resource('customers', App\Http\Controllers\User\CustomerController::class);

});

    // Order Details (like a bill)
    // Route::resource('order-details', App\Http\Controllers\OrdersController::class);

    // Customers (nanti request-only email sama password aja, terus dia kan rolenya default user, pake custom login logic)
    // Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware(['auth', 'admin']);

    // Users
    // Route::resource('users', App\Http\Controllers\ProductReviewsController::class);