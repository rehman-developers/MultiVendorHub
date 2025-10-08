<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function user(){
        return view('welcome');
    }
    public function blog(){
        return view('blogs');
    }

     public function img(string $id){
        return view('img',compact('id'));
    }
}
