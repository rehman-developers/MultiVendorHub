{{-- resources/views/admin/stores/show.blade.php --}}
@extends('layouts.app')

@section('title', $store->name . ' - Store Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6">
    <div class="container mx-auto max-w-7xl">

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
        <!-- Store Header -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
            <div class="flex items-center space-x-6 flex-1">
                <div class="w-28 h-28 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 p-1 shadow-lg">
                    @if($store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="w-full h-full object-cover rounded-full">
                    @else
                        <div class="w-full h-full bg-white rounded-full flex items-center justify-center text-indigo-600 font-bold text-3xl">
                            {{ Str::substr($store->name, 0, 2) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-800">{{ $store->name }}</h1>
                    <p class="text-lg text-gray-600 mt-1">
                        Owner: <span class="font-bold text-indigo-600">{{ $store->user->name ?? 'Unknown' }}</span>
                    </p>
                    <p class="text-sm text-gray-500">{{ $store->user->email ?? 'No email' }}</p>
                </div>
            </div>

            <div class="text-center md:text-right space-y-2">
                <p class="text-4xl font-bold text-green-600">
                    {{ $completedOrders->sum('completed_orders_count') }}
                </p>
                <p class="text-sm font-medium text-gray-600">Completed Orders</p>
            </div>

            <div class="text-center md:text-right space-y-2">
                <p class="text-4xl font-bold text-indigo-600">
                    ${{ number_format($totalRevenue, 2) }}
                </p>
                <p class="text-sm font-medium text-gray-600">Total Revenue</p>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Products & Performance</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 font-bold">Product</th>
                            <th class="px-6 py-4 font-bold text-center">Price</th>
                            <th class="px-6 py-4 font-bold text-center">Completed Orders</th>
                            <th class="px-6 py-4 font-bold text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($completedOrders as $product)
                            <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        @if($product->image && \Storage::disk('public')->exists($product->image))
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-14 h-14 object-cover rounded-lg shadow">
                                        @else
                                            <div class="w-14 h-14 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                                No Image
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-gray-800 text-lg">{{ $product->name }}</p>
                                            <p class="text-sm text-gray-500">ID: #{{ $product->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 font-bold rounded-full text-lg">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-block px-5 py-2 bg-green-100 text-green-700 font-bold rounded-full text-xl">
                                        {{ $product->completed_orders_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-1">
                                        @php
                                            $avg = $product->reviews->avg('rating') ?? 0;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-6 h-6 {{ $i <= $avg ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.16c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.953c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.953a1 1 0 00-.364-1.118L2.317 9.38c-.783-.57-.38-1.81.588-1.81h4.16a1 1 0 00.95-.69l1.286-3.953z"/>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-medium text-gray-600">
                                            ({{ $product->reviews->count() }})
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-16 text-gray-500 text-lg">
                                    No products found.
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