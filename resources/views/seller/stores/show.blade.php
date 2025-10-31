@extends('layouts.app')

@section('title', 'View Store')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-4 text-indigo-600">{{ $store->name }}</h1>
        <p class="text-gray-600 mb-8">{{ $store->description ?? 'No description' }}</p>
        
        <h2 class="text-2xl font-bold mb-4">Products in this Store</h2>
        @if ($store->products->isEmpty())
            <p class="text-gray-600">No products in this store yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($store->products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="mt-8 text-center">
            <a href="{{ route('seller.stores.edit', $store->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">Edit Store</a>
            <a href="{{ route('seller.stores.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Back to Stores</a>
        </div>
    </div>
@endsection