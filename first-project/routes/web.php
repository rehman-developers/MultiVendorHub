<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;


Route::controller(PageController::class)->group(function(){

    Route::get('/','user')->name('home');
    Route::get('/blog','blog')->name('blog');
    Route::get('/img/{id}','img')->name('img');
});

Route::get('test',TestController::class);

//Home Page
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/img',function(){
//     return view('img');
// });
// Route::get('/blogs',function(){
//     return view('blogs');
// });

// Route::prefix('abdulrehman')->group(function(){

//     // open page with  just id(number)   
//     Route::get('id/{id}',function($id){
//         return '<h1> Hi Laravel Post ID is : '. $id .'</h1>';
//     })->whereNumber('id');
    
//     // open page with  just name(10num10sa)
//     Route::get('/char/{name}',function($name){
//         return '<h1> Hi Laravel Post Alpha Number is : '. $name .'</h1>';
//     })->whereAlphaNumeric('name');
    
    
//     // open page with  just character(Character)
//     Route::get('/alpha/{name}',function($hehe){
//         return '<h1> Hi Laravel Char Alpha is : '. $hehe .'</h1>';
//     })->whereAlpha('name');
    
    
//     // open page with  just one category in one time(select)
//     Route::get('/category/{name}',function($hehe){
//         return '<h1> Hi Laravel your Category is : '. $hehe .'</h1>';
//     })->whereIn('name',['movie','book']);
    
//     Route::get('/regex/@{id}', function ($id) {
//         return "Regex ID: $id";
//     })->where('id', '[0-9]+');
    
    
//     Route::get('/{id}/comment/{commentid}', function ($id, $commentid) {
//         return "Regex ID: " . $id . " , " . $commentid;
//     })->where('id', '[0-9]+')->whereAlpha('commentid');
    
// });
// //Fetch the page in one line
// Route::view('/blogs','blogs');

// //After blogs file 

// Route::get('/blogs/img', function(){
//     return view('img');
// });

// Route::get('/blogsssss',function(){
//     return view('blogs');
// })->name('post');

// Route::redirect('/img','/blogs');