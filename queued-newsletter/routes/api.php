<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;

Route::get('/subscribers', [SubscriberController::class, 'apiIndex']);