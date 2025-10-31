@extends('layouts.app')

@section('title', 'Welcome to MultiVendorHub')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="relative">
            <img src="https://via.placeholder.com/1200x400?text=Welcome+to+MultiVendorHub" alt="Hero Image" class="w-full h-96 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-5xl font-bold mb-4">Discover Amazing Products</h1>
                    <p class="text-xl mb-6">Shop from multiple sellers in one place</p>
                    <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full transition duration-300">Get Started</a>
                </div>
            </div>
        </div>
        
        <div class="py-12 px-8">
            <h2 class="text-3xl font-bold text-center mb-10">Featured Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($featuredProducts ?? [] as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4">${{ number_format($product->price, 2) }}</p>
                            <a href="#" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded block text-center">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 px-8">
            <h2 class="text-3xl font-bold text-center mb-10">Why Choose MultiVendorHub?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <i class="fas fa-store text-5xl text-indigo-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Multiple Sellers</h3>
                    <p class="text-gray-600">Shop from various stores in one platform.</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-shield-alt text-5xl text-indigo-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Secure Checkout</h3>
                    <p class="text-gray-600">Safe and easy payments.</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-truck text-5xl text-indigo-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                    <p class="text-gray-600">Get your orders quickly.</p>
                </div>
            </div>
        </div>
    </div>
@endsection