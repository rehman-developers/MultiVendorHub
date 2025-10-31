{{-- resources/views/seller/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Seller Dashboard')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">

    {{-- Back to Home Button --}}
    <div class="mb-6">
        <a href="{{ route('seller.home') }}"
           class="inline-flex items-center px-5 py-2.5 bg-gray-700 hover:bg-gray-800 text-white font-medium rounded-lg transition shadow">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
             Home
        </a>
    </div>

    <h1 class="text-4xl font-bold text-center text-indigo-700 mb-10">Seller Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Products</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Sales</h3>
                    <p class="text-3xl font-bold mt-2">${{ number_format($totalSales, 2) }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Pending Orders</h3>
                    <p class="text-3xl font-bold mt-2">{{ $pendingOrders }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Low Stock</h3>
                    <p class="text-3xl font-bold mt-2">{{ $lowStockProducts }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Recent Products --}}
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-2xl font-bold text-gray-800">Recent Products</h2>
            <a href="{{ route('seller.products.index') }}"
               class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                View All
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        @if($products->isEmpty())
            <p class="text-center text-gray-500 py-8">No products yet. <a href="{{ route('seller.products.create') }}" class="text-indigo-600">Add one!</a></p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-left text-sm font-medium text-gray-600 border-b">
                            <th class="pb-3">Name</th>
                            <th class="pb-3">Price</th>
                            <th class="pb-3">Stock</th>
                            <th class="pb-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($products as $product)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3">{{ Str::limit($product->name, 30) }}</td>
                            <td class="py-3">${{ number_format($product->price, 2) }}</td>
                            <td class="py-3">
                                <span class="{{ $product->stock < 10 ? 'text-red-600' : 'text-green-600' }} font-medium">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="py-3 text-center space-x-2">
                                <a href="{{ route('seller.products.edit', $product->id) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this product?')"
                                            class="text-red-600 hover:text-red-800 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- PENDING ORDERS – ONLY CONFIRMED/PENDING (NO CANCELLED) --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-2xl font-bold text-gray-800">Pending Orders</h2>
            <a href="{{ route('seller.orders.index') }}"
               class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                View All Orders
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        @if($pendingOrdersList->isEmpty())
            <p class="text-center text-gray-500 py-8">No Order!</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-left text-sm font-medium text-gray-600 border-b">
                            <th class="pb-3">Order ID</th>
                            <th class="pb-3">Buyer</th>
                            <th class="pb-3">Total</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($pendingOrdersList as $order)
                            @if($order->status !== 'cancelled') {{-- HIDE CANCELLED --}}
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 font-medium">#{{ $order->id }}</td>
                                    <td class'.py-3'>
                                        <p class="font-semibold">{{ $order->buyer->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->buyer->email }}</p>
                                    </td>
                                    <td class="py-3 font-bold text-indigo-600">
                                        ${{ number_format($order->total, 2) }}
                                    </td>
                                    <td class="py-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                            <form action="{{ route('seller.orders.complete', $order->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition transform hover:scale-105 shadow-md"
                                                        onclick="return confirm('Complete this Order?')">
                                                    Complete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 text-xs font-medium">
                                                {{ $order->status === 'completed' ? 'Done' : 'Cancelled' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection