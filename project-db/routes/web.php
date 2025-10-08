<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::controller(StudentController::class)->group(function(){

    Route::get('/','showStudent')->name('home');

    Route::get('/st/{id}','singleStudent')->name('student');

    Route::post('/add','addStudent')->name('addStudent');

    Route::put('/up/{id}','updateStudent')->name('up');
    Route::get('/updatePage/{id}','updatePage')->name('update');

    Route::get('/del','deleteStudent');

    Route::get('/del/{id}','deleteStudent')->name('delete');
});


Route::view('new','/addStudent');
// Route::get('/hi', function () {
//     return "Hello";
// });
