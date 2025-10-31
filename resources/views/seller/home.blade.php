@extends('layouts.app')

@section('title', 'Seller Home')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-indigo-600">Welcome to Your Seller Home</h1>
    <p class="text-lg text-center mb-8">Manage your store, products, and more from here.</p>

    {{-- Quick Links --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('seller.dashboard') }}"
            class="bg-blue-100 rounded-lg p-6 text-center shadow hover:bg-blue-200 transition">
            <i class="fas fa-chart-line text-4xl text-blue-600 mb-4"></i>
            <h2 class="text-xl font-semibold">Dashboard</h2>
            <p class="text-gray-600">View analytics and overview</p>
        </a>
        <a href="{{ route('seller.products.index') }}"
            class="bg-green-100 rounded-lg p-6 text-center shadow hover:bg-green-200 transition">
            <i class="fas fa-box-open text-4xl text-green-600 mb-4"></i>
            <h2 class="text-xl font-semibold">Products</h2>
            <p class="text-gray-600">Manage your products</p>
        </a>
        <a href="{{ route('seller.stores.index') }}"
            class="bg-purple-100 rounded-lg p-6 text-center shadow hover:bg-purple-200 transition">
            <i class="fas fa-store text-4xl text-purple-600 mb-4"></i>
            <h2 class="text-xl font-semibold">Stores</h2>
            <p class="text-gray-600">Manage your stores</p>
        </a>
    </div>

    {{-- Recent Products --}}
    <div class="mb-10">
        <h2 class="text-2xl font-bold mb-4">Recent Products</h2>
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left">Product Name</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProducts ?? [] as $product)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4">{{ $product->stock }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No products yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection