<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\TestUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::view('login','login')->name('login');
Route::post('loginMatch',[AuthController::class,'login'])->name('loginMatch');

Route::view('register','register')->name('register');
Route::post('registerSave',[AuthController::class,'register'])->name('registerSave');

// Route::get('dashboard',[AuthController::class,'dashboardPage'])
// ->name('dashboard');

// Route::get('dashboard/inner',[AuthController::class,'innerPage'])
// ->name('inner');










// Route::get('dashboard',[AuthController::class,'dashboardPage'])
// ->name('dashboard')->middleware(['IsValidUser:guest,admin',TestUser::class]);

// Route::get('dashboard/inner',[AuthController::class,'innerPage'])
// ->name('inner')->middleware(['IsValidUser:guest',TestUser::class]);










Route::get('dashboard',[AuthController::class,'dashboardPage'])
->name('dashboard')->middleware(["auth",'IsValidUser:admin']);

Route::get('dashboard/inner',[AuthController::class,'innerPage'])
->name('inner')->middleware(['auth','IsValidUser:admin']);






// Route::middleware('ok-user')->group(function(){

// Route::get('dashboard',[AuthController::class,'dashboardPage'])->name('dashboard');
// Route::get('dashboard/inner',[AuthController::class,'innerPage'])
// ->name('inner')->withoutmiddleware([TestUser::class]);

// });
Route::get('logout',[AuthController::class,'logout'])->name('logout');