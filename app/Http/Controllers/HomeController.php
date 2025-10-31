<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        $products = Product::with('category')->limit(6)->get(); // Fetch a few products for welcome blade
        return view('welcome', compact('products'));
    }
}