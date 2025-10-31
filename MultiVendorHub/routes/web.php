<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'landing'])->name('landing');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/seller.php';
require __DIR__.'/buyer.php';
require __DIR__.'/api.php';
require __DIR__.'/superAdmin.php';