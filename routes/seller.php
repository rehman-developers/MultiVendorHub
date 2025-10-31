<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;

Route::middleware(['auth', 'seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        // Home & Dashboard
        Route::get('/', [SellerDashboardController::class, 'index'])->name('home');
        Route::get('/dashboard', [SellerDashboardController::class, 'dashboard'])->name('dashboard');

        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        });

        // Stores
        Route::prefix('stores')->name('stores.')->group(function () {
            Route::get('/', [StoreController::class, 'index'])->name('index');
            Route::get('/create', [StoreController::class, 'create'])->name('create');
            Route::post('/', [StoreController::class, 'store'])->name('store');
            Route::get('/{id}', [StoreController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [StoreController::class, 'edit'])->name('edit');
            Route::put('/{id}', [StoreController::class, 'update'])->name('update');
            Route::delete('/{id}', [StoreController::class, 'destroy'])->name('destroy');
        });

        // === ORDERS – CLEAN URL: /seller/orders ===
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [SellerDashboardController::class, 'orders'])->name('index'); // /seller/orders
            Route::patch('/{order}/complete', [SellerDashboardController::class, 'completeOrder'])->name('complete'); // /seller/orders/10/complete
        });
    });