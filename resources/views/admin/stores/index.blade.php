@extends('layouts.app')

@section('title', 'All Stores')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6">
    <div class="container mx-auto max-w-7xl">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-10">All Stores</h1>

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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($stores as $store)
                <a href="{{ route('admin.stores.show', $store) }}"
                   class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition transform hover:scale-105 block">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 p-1">
                            @if($store->logo)
                                <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="w-full h-full object-cover rounded-full">
                            @else
                                <div class="w-full h-full bg-white rounded-full flex items-center justify-center text-indigo-600 font-bold text-xl">
                                    {{ Str::substr($store->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $store->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $store->user?->email ?? '' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-center mt-4">
                        <div>
                            <p class="text-2xl font-bold text-green-600">{{ $store->completed_orders_count }}</p>
                            <p class="text-xs text-gray-600">Completed Orders</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-indigo-600">${{ number_format($store->total_revenue, 2) }}</p>
                            <p class="text-xs text-gray-600">Revenue</p>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-center items-center space-x-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $store->avg_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.16c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.953c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.953a1 1 0 00-.364-1.118L2.317 9.38c-.783-.57-.38-1.81.588-1.81h4.16a1 1 0 00.95-.69l1.286-3.953z"/>
                            </svg>
                        @endfor
                        <span class="ml-1 text-sm text-gray-600">({{ $store->reviews_count }})</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No stores found.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection