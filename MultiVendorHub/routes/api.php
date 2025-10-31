<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    // Add more API routes here
});