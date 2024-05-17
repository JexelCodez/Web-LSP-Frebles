<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TransactionController;

// Root goes to landingpage
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// Subscriber URL
Route::post('subscribe', [SubscriptionController::class, 'sendSubscription'])->middleware(['auth']);

// Shop Page
Route::get('shop', [HomeController::class, 'showShop'])->name('landingpage-items.shop');

// Contact Page
Route::get('contact', [HomeController::class, 'showContact'])->name('landingpage-items.contact');

// Contact Message
Route::post('message', [App\Http\Controllers\MessageController::class, 'store'])->name('message.store');

// Product Details Page
Route::get('product-details/{id}', [HomeController::class, 'showProductDetails'])->name('landingpage-items.product-details');

// Cart Page
Route::get('cart', [CartController::class, 'showCart'])->name('landingpage-items.cart')->middleware(['auth']);
Route::post('add_cart/{id}', [CartController::class, 'AddToCart'])->name('landingpage-items.add-to-cart')->middleware(['auth']);
Route::get('remove_cart/{id}', [CartController::class, 'removeCart'])->name('landingpage-items.remove-from-cart')->middleware(['auth']);

// Payment Form Page
Route::get('payment-form/{orderId}', [TransactionController::class, 'index'])->name('landingpage-items.payment-form');
Route::get('cartOrder', [CartController::class, 'cartOrder'])->name('cart.order');

// Payment Methods Route 
Route::get('cashPayment/{orderId}', [TransactionController::class, 'CashOnDelivery'])->name('CashOnDelivery')->middleware(['auth']);
Route::get('eWalletPayment/{orderId}', [TransactionController::class, 'eWallet'])->name('eWallet');


// Deliver Product
Route::get('deliver/initiate/{orderId}', [DeliverController::class, 'initiateDelivery'])->name('delivery.initiate');


// Customers
Route::get('admin/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
Route::get('customers/create', [App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customers.create');
Route::post('customers', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customers.store');
// Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);

// Wishlists
Route::get('admin/wishlists', [App\Http\Controllers\Admin\WishlistController::class, 'index'])->name('wishlists.index');
Route::get('wishlists/create', [App\Http\Controllers\Admin\WishlistController::class, 'create'])->name('wishlists.create');
Route::post('wishlists', [App\Http\Controllers\Admin\WishlistController::class, 'store'])->name('wishlists.store');

// Product Reviews
Route::get('admin/product-reviews', [App\Http\Controllers\User\ProductReviewsController::class, 'index'])->name('product-reviews.index');
Route::get('product-reviews/create', [App\Http\Controllers\User\ProductReviewsController::class, 'create'])->name('product-reviews.create');
Route::post('product-reviews', [App\Http\Controllers\User\ProductReviewsController::class, 'store'])->name('product-reviews.store');


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

    // Order Details
    Route::resource('order_details', App\Http\Controllers\Admin\OrderDetailsController::class);
});


// User Auth

Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    // Admin-specific routes
    Route::get('dashboard', [HomeController::class, 'showUserDashboard']);

    // Orders
    // Route::resource('orders', App\Http\Controllers\User\OrderController::class);
    Route::get('orders', [App\Http\Controllers\User\OrderController::class, 'index']);

    // Payments
    Route::resource('payments', App\Http\Controllers\User\PaymentController::class);

    // Wishlists
    // Route::resource('wishlists', App\Http\Controllers\User\WishlistController::class);

    // Product Reviews
    // Route::resource('product-reviews', App\Http\Controllers\User\ProductReviewsController::class);

});

    // Order Details (like a bill)
    // Route::resource('order-details', App\Http\Controllers\OrdersController::class);

    // Users
    // Route::resource('users', App\Http\Controllers\ProductReviewsController::class);