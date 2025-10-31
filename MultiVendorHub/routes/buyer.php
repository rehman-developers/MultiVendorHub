<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\BuyerController;

Route::middleware(['auth', 'buyer'])
    ->prefix('buyer') // Add prefix to avoid conflict with root /
    ->name('buyer.')
    ->group(function () {
       // Home & Dashboard
    Route::get('/', [BuyerController::class, 'index'])->name('home');
    Route::get('/dashboard', [BuyerController::class, 'dashboard'])->name('dashboard');

    // Cart
    Route::post('/cart/{product}', [BuyerController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [BuyerController::class, 'cart'])->name('cart');
    Route::post('/cart/{item}/update', [BuyerController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{item}', [BuyerController::class, 'removeFromCart'])->name('cart.remove');

    // Checkout & Address
    Route::get('/address/edit', [BuyerController::class, 'editAddress'])->name('address.edit');
    Route::post('/address/update', [BuyerController::class, 'updateAddress'])->name('address.update');
    Route::post('/checkout', [BuyerController::class, 'checkout'])->name('checkout');

    // Orders
    Route::get('/orders', [BuyerController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [BuyerController::class, 'showOrder'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [BuyerController::class, 'cancelOrder'])->name('orders.cancel');
    Route::patch('/orders/{order}/update-details', [BuyerController::class, 'updateOrderDetails'])->name('orders.update-details');
    Route::post('/orders/{order}/confirm', [BuyerController::class, 'confirmOrder'])->name('orders.confirm');
    Route::get('/orders/{order}/pay', [BuyerController::class, 'payWithCard'])->name('orders.pay');
    Route::post('/orders/{order}/pay/process', [BuyerController::class, 'processCardPayment'])->name('orders.pay.process');

    // Reviews
    Route::post('/products/{product}/review', [BuyerController::class, 'addReview'])->name('review.add');
    Route::get('/reviews', [BuyerController::class, 'reviews'])->name('reviews');
    });