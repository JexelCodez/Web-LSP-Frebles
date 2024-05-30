<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;

// Root goes to landingpage
Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

// Contact Message
Route::post('message', [MessageController::class, 'store'])->name('message.store');

// Subscriber URL
Route::post('subscribe', [SubscriptionController::class, 'sendSubscription'])->middleware(['auth']);

// Shop Page
Route::get('shop', [HomeController::class, 'showShop'])->name('landingpage-items.shop');

// Search Input
Route::get('searchProduct', [ShopController::class, 'searchProduct'])->name('searchProduct');

// Contact Page
Route::get('contact', [HomeController::class, 'showContact'])->name('landingpage-items.contact');

// Product Details Page
Route::get('product-details/{id}', [HomeController::class, 'showProductDetails'])->name('landingpage-items.product-details');

// Cart Page
Route::get('cart', [CartController::class, 'showCart'])->name('landingpage-items.cart')->middleware(['auth']);
Route::post('add_cart/{id}', [CartController::class, 'AddToCart'])->name('landingpage-items.add-to-cart')->middleware(['auth']);
Route::get('remove_cart/{id}', [CartController::class, 'removeCart'])->name('landingpage-items.remove-from-cart')->middleware(['auth']);

// Payment Form Page
Route::get('payment-form/{orderId}', [TransactionController::class, 'index'])->name('landingpage-items.payment-form')->middleware(['auth']);
Route::get('cartOrder', [CartController::class, 'cartOrder'])->name('cart.order')->middleware(['auth']);

// Payment Methods Route 
Route::get('cashPayment/{orderId}', [TransactionController::class, 'CashOnDelivery'])->name('CashOnDelivery')->middleware(['auth']);
Route::get('eWalletPayment/{orderId}', [TransactionController::class, 'eWallet'])->name('eWallet')->middleware(['auth']);

// Deliver Product
Route::get('deliver/initiate/{orderId}', [DeliverController::class, 'initiateDelivery'])->name('delivery.initiate')->middleware(['auth']);

// Customers
Route::get('customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create')->middleware(['auth']);
Route::post('customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store')->middleware(['auth']);

// Wishlists
Route::get('wishlist/create', [App\Http\Controllers\WishlistController::class, 'create'])->name('wishlists.create')->middleware(['auth']);
Route::post('wishlist', [App\Http\Controllers\WishlistController::class, 'store'])->name('wishlists.store')->middleware(['auth']);

// Product Reviews
Route::get('product-reviews/create', [App\Http\Controllers\ProductReviewsController::class, 'create'])->name('product-reviews.create')->middleware(['auth']);
Route::post('product-reviews', [App\Http\Controllers\ProductReviewsController::class, 'store'])->name('product-reviews.store')->middleware(['auth']);

// Orders Show To User
Route::get('show_orders', [App\Http\Controllers\OrderController::class, 'showOrder'])->name('show_orders')->middleware(['auth']);
Route::get('cancel_order/{id}', [App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('cancel_order')->middleware(['auth']);

// Wishlists Show To User
Route::get('show_wishlists', [App\Http\Controllers\WishlistController::class, 'showWish'])->name('show_wishlists')->middleware(['auth']);
Route::get('delete_wish/{id}', [App\Http\Controllers\WishlistController::class, 'deleteWish'])->name('delete_wish')->middleware(['auth']);

// Reviews Show To User
Route::get('show_reviews', [App\Http\Controllers\ProductReviewsController::class, 'showReview'])->name('show_reviews')->middleware(['auth']);
Route::get('delete_review/{id}', [App\Http\Controllers\ProductReviewsController::class, 'deleteReview'])->name('delete_review')->middleware(['auth']);

// Payments
// Route::get('admin/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->middleware(['auth'])->name('payments.index');


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

// Search Data
Route::get('search_admin_product', [HomeController::class, 'searchAdminProduct'])->middleware(['auth']);
Route::get('search_admin_product_categories', [HomeController::class, 'searchAdminProductCategories'])->middleware(['auth']);
Route::get('search_admin_customer', [HomeController::class, 'searchAdminCustomer'])->middleware(['auth']);
Route::get('search_admin_wishlist', [HomeController::class, 'searchAdminWishlist'])->middleware(['auth']);
Route::get('search_admin_order', [HomeController::class, 'searchAdminOrder'])->middleware(['auth']);
Route::get('search_admin_order_details', [HomeController::class, 'searchAdminOrderDetails'])->middleware(['auth']);
Route::get('search_admin_delivery', [HomeController::class, 'searchAdminDelivery'])->middleware(['auth']);
Route::get('search_admin_payment', [HomeController::class, 'searchAdminPayment'])->middleware(['auth']);
Route::get('search_admin_discount', [HomeController::class, 'searchAdminDiscount'])->middleware(['auth']);
Route::get('search_admin_discount_categories', [HomeController::class, 'searchAdminDiscountCategories'])->middleware(['auth']);

// Admin Auth //

// Route Data
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

    // Customers
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);

    // Users
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Wishlists
    Route::resource('wishlists', App\Http\Controllers\Admin\WishlistController::class);
});


// Owner Auth

Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {

    // Owner-specific routes
    Route::get('dashboard', [HomeController::class, 'showOwnerDashboard']);
});