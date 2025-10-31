@extends('layouts.app')

@section('title', 'Buyer Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-10 px-4">

    <div class="container mx-auto max-w-7xl">

        {{-- Back to Shop --}}
        <div class="mb-8">
            <a href="{{ route('buyer.home') }}"
               class="group inline-flex items-center px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <svg class="w-5 h-5 mr-2 text-indigo-600 group-hover:-translate-x-1 transition" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium text-gray-700">Back to Shop</span>
            </a>
        </div>

        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent animate-pulse">
                Buyer Dashboard
            </h1>
            <p class="mt-3 text-lg text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
        </div>

        {{-- Stats Cards – Glassmorphism + Gradient --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- My Orders -->
            <div class="group relative overflow-hidden rounded-2xl bg-white/70 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-indigo-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">My Orders</p>
                            <p class="text-4xl font-bold text-gray-800 mt-1">{{ $orderCount }}</p>
                        </div>
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h18l-2 14H5L3 3zM7 21a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('buyer.orders') }}"
                       class="mt-4 inline-block text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                        View All →
                    </a>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="group relative overflow-hidden rounded-2xl bg-white/70 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-rose-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Wishlist</p>
                            <p class="text-4xl font-bold text-gray-800 mt-1">{{ $wishlistCount }}</p>
                        </div>
                        <div class="p-3 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="#" class="mt-4 inline-block text-sm font-medium text-pink-600 hover:text-pink-800 transition">
                        View Wishlist →
                    </a>
                </div>
            </div>

            <!-- Reviews -->
            <div class="group relative overflow-hidden rounded-2xl bg-white/70 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-indigo-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">My Reviews</p>
                            <p class="text-4xl font-bold text-gray-800 mt-1">{{ $reviewCount }}</p>
                        </div>
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('buyer.reviews') }}"
                       class="mt-4 inline-block text-sm font-medium text-purple-600 hover:text-purple-800 transition">
                        View All →
                    </a>
                </div>
            </div>
        </div>

        {{-- Shipping & Payment Button --}}
        <div class="flex justify-center mb-10">
            <a href="{{ route('buyer.address.edit') }}"
               class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-lg rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-6 h-6 mr-3 group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Update Shipping & Payment
            </a>
        </div>

        {{-- Recent Orders --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 mb-8 border border-white/30">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="w-7 h-7 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Recent Orders
                </h2>
                <a href="{{ route('buyer.orders') }}"
                   class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center text-sm">
                    View All
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            @if($recentOrders->isEmpty())
                <div class="text-center py-12">
                    <img src="{{ asset('images/empty-orders.svg') }}" alt="No Orders" class="w-32 mx-auto mb-4 opacity-60">
                    <p class="text-gray-500">No orders yet. Start shopping!</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">
                            <tr>
                                <th class="pb-3">Order ID</th>
                                <th class="pb-3">Date</th>
                                <th class="pb-3">Amount</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($recentOrders as $order)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 font-medium">#{{ $order->id }}</td>
                                <td class="py-4 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="py-4 font-semibold text-indigo-600">${{ number_format($order->total, 2) }}</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- My Reviews --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-white/30">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="w-7 h-7 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.905c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    My Reviews
                </h2>
                <a href="{{ route('buyer.reviews') }}"
                   class="text-purple-600 hover:text-purple-800 font-medium flex items-center text-sm">
                    View All
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            @if($reviews->isEmpty())
                <div class="text-center py-12">
                    <img src="{{ asset('images/no-reviews.svg') }}" alt="No Reviews" class="w-32 mx-auto mb-4 opacity-60">
                    <p class="text-gray-500">No reviews yet. Share your feedback!</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($reviews as $review)
                    <div class="flex items-start space-x-4 p-4 bg-gray-50/50 rounded-xl hover:bg-gray-100/50 transition">
                        <img src="{{ $review->product->image ?? asset('images/placeholder.jpg') }}"
                             alt="{{ $review->product->name }}" class="w-16 h-16 object-cover rounded-lg shadow">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">{{ Str::limit($review->product->name, 40) }}</h4>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-500 text-sm">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </span>
                                <span class="ml-2 text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            @if($review->comment)
                                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($review->comment, 100) }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

{{-- Optional: Add subtle animation --}}
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
</style>
@endsection