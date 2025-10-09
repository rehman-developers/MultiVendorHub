<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SchoolController;

Route::get('/teachers', [SchoolController::class, 'showTeachers']);

