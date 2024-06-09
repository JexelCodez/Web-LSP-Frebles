<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Midtrans Callback
Route::post('midtrans-callback', [TransactionController::class, 'callback'])->name('midtrans.callback');

// Midtrans Invoice
Route::get('invoice', [TransactionController::class, 'invoice'])->name('invoice');

