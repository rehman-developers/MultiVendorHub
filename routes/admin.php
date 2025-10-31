<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\AdminUserController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Home
    Route::get('/', [AdminDashboardController::class, 'home'])->name('home');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // USER MANAGEMENT
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/status', [AdminUserController::class, 'updateStatus'])->name('users.status');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    
    // Admin Approval
    Route::post('/approve/{user}', [AdminUserController::class, 'approve'])->name('approve');
    Route::post('/reject/{user}', [AdminUserController::class, 'reject'])->name('reject');

    // STORES ROUTES – ADD THIS
    Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
    Route::get('/stores/{store}', [StoreController::class, 'show'])->name('stores.show');
});