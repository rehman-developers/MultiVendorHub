{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6">
    <div class="container mx-auto max-w-7xl">

        <h1
            class="text-5xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-10">
            Admin Dashboard
        </h1>
        <!-- Back to Home Button -->
        <div class="mb-6">
            <a href="{{ route('admin.home') }}" 
               class="inline-flex items-center px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-1a1 1 0 001-1v-10m-9 0h6"></path>
                </svg>
                Back to Home
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold">Total Users</h3>
                <p class="text-4xl font-bold mt-2">{{ $totalUsers }}</p>
            </div>

            <div
                class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold">Total Sellers</h3>
                <p class="text-4xl font-bold mt-2">{{ $totalSellers }}</p>
            </div>

            <div
                class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold">Completed Orders</h3>
                <p class="text-4xl font-bold mt-2">{{ $completedOrders }}</p>
            </div>

            <div
                class="bg-gradient-to-br from-yellow-500 to-orange-600 text-white p-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold">Total Revenue</h3>
                <p class="text-4xl font-bold mt-2">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>

        {{-- Stores Performance --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Stores Performance</h2>
                <a href="{{ route('admin.stores.index') }}" class="text-indigo-600 hover:underline font-medium">
                    View All
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 font-bold">Store</th>
                            <th class="px-6 py-4 font-bold text-center">Completed Orders</th>
                            <th class="px-6 py-4 font-bold text-center">Rating</th>
                            <th class="px-6 py-4 font-bold text-center">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($stores as $store)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 p-1">
                                        @if($store->logo)
                                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}"
                                            class="w-full h-full object-cover rounded-full">
                                        @else
                                        <div
                                            class="w-full h-full bg-white rounded-full flex items-center justify-center text-indigo-600 font-bold text-lg">
                                            {{ Str::substr($store->name, 0, 2) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $store->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $store->user?->email ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-green-600">
                                {{ $store->completed_orders_count }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++) <svg
                                        class="w-5 h-5 {{ $i <= $store->avg_rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.16c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.953c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.953a1 1 0 00-.364-1.118L2.317 9.38c-.783-.57-.38-1.81.588-1.81h4.16a1 1 0 00.95-.69l1.286-3.953z" />
                                        </svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-medium text-gray-600">
                                            ({{ $store->reviews_count }} reviews)
                                        </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-indigo-600">
                                ${{ number_format($store->total_revenue, 2) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                No stores found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Completed Orders --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Recent Completed Orders</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                        <tr>
                            <th class="px-6 py-4 font-bold">Order ID</th>
                            <th class="px-6 py-4 font-bold">Buyer</th>
                            <th class="px-6 py-4 font-bold">Store</th>
                            <th class="px-6 py-4 font-bold text-center">Amount</th>
                            <th class="px-6 py-4 font-bold text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentCompletedOrders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">#{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->buyer->name }}</td>
                            <td class="px-6 py-4">
                                @if($order->items->first()?->product?->store)
                                <span class="text-indigo-600 font-medium">
                                    {{ $order->items->first()->product->store->name }}
                                </span>
                                @else
                                <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-green-600">
                                ${{ number_format($order->total, 2) }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-600">
                                {{ $order->created_at->format('d M, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500">
                                No completed orders yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection