<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminStoreController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Buyer\BuyerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ImpersonateController;

// SUPER ADMIN: FULL ACCESS
Route::middleware(['auth', 'super_admin'])->group(function () {

    // Impersonate
    Route::get('/impersonate/{user}', [ImpersonateController::class, 'impersonate'])->name('impersonate');
    Route::get('/impersonate/stop', [ImpersonateController::class, 'stop'])->name('impersonate.stop');
});