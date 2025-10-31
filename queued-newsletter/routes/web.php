<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/subscribe', [SubscriberController::class, 'showForm'])->name('subscribe.form');
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe.submit')->middleware('subscribe.rate');
Route::get('/success', function () {
    return view('success');
})->name('success');

Route::get('/dashboard', [SubscriberController::class, 'dashboard'])->name('dashboard');