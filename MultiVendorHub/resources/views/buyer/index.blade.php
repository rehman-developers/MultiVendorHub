@extends('layouts.app')

@section('title', 'Shop Products')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">

    {{-- Header: Dashboard & Cart --}}
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('buyer.dashboard') }}"
                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('buyer.cart') }}"
                class="relative inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition transform hover:scale-105">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Cart
                @if($cartCount > 0)
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center animate-pulse">
                    {{ $cartCount }}
                </span>
                @endif
            </a>
        </div>
    </header>

    <div class="container mx-auto p-6">
        <h1
            class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-10">
            Shop Amazing Products
        </h1>

        {{-- Success Message --}}
        @if(session('success'))
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg mb-6 shadow-sm flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Search & Filter --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mb-10">
            <form method="GET" action="{{ route('buyer.home') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ old('search', $search) }}"
                        placeholder="e.g., laptop, shirt..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $category_id)==$cat->id ? 'selected' : ''
                            }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-2.5 rounded-lg shadow-md transition transform hover:scale-105">
                        Search & Filter
                    </button>
                </div>
            </form>
        </div>

        {{-- Products Grid --}}
        @if($products->isEmpty())
        <div class="text-center py-16">
            <img src="{{ asset('images/empty-cart.svg') }}" alt="No products" class="w-48 mx-auto mb-6 opacity-60">
            <p class="text-xl text-gray-600 mb-4">No products found.</p>
            <a href="{{ route('buyer.home') }}" class="text-indigo-600 hover:underline font-medium">Clear filters</a>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
            @php
            $store = $product->store;
            @endphp
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 group">
                {{-- Store Info (Logo + Name) --}}
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-white p-1 shadow-md">
                        @if($store && $store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}"
                            class="w-full h-full object-cover rounded-full">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full"></div>
                        @endif
                    </div>
                    <div class="text-white">
                        <p class="text-xs font-medium">From</p>
                        <p class="text-sm font-bold">{{ $store ? $store->name : 'Unknown Store' }}</p>
                    </div>
                </div>

                {{-- Product Image --}}
                <div class="relative">
                    <img src="{{ $product->image ?? asset('images/placeholder.jpg') }}" alt="{{ $product->name }}"
                        class="w-full h-56 object-cover group-hover:opacity-90 transition">
                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                        {{ $product->stock < 10 ? "Only {$product->stock} left!" : 'In Stock' }} </div>
                    </div>

                    {{-- Product Details --}}
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">{{ Str::limit($product->name, 50)
                            }}</h3>
                        <p class="text-2xl font-extrabold text-indigo-600 mb-3">${{ number_format($product->price, 2) }}
                        </p>

                        <form action="{{ route('buyer.cart.add', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:scale-105 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- ATTRACTIVE PAGINATION --}}
            <div class="mt-16 flex justify-center">
                <nav class="inline-flex rounded-lg shadow-lg bg-white overflow-hidden">
                    {{-- Previous Button --}}
                    @if($products->onFirstPage())
                    <span class="px-4 py-3 text-gray-400 cursor-not-allowed bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </span>
                    @else
                    <a href="{{ $products->appends(request()->query())->previousPageUrl() }}"
                        class="px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white hover:from-indigo-600 hover:to-purple-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                    <span class="px-5 py-3 bg-indigo-600 text-white font-bold">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}"
                        class="px-5 py-3 bg-white text-indigo-600 hover:bg-indigo-50 transition font-medium">
                        {{ $page }}
                    </a>
                    @endif
                    @endforeach

                    {{-- Next Button --}}
                    @if($products->hasMorePages())
                    <a href="{{ $products->appends(request()->query())->nextPageUrl() }}"
                        class="px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white hover:from-indigo-600 hover:to-purple-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                    @else
                    <span class="px-4 py-3 text-gray-400 cursor-not-allowed bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </span>
                    @endif
                </nav>
            </div>
            @endif
        </div>
    </div>
    @endsection