{{-- resources/views/admin/users/show.blade.php --}}
@extends('layouts.app')

@section('title', $user->name . ' - User Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-6">
    <div class="container mx-auto max-w-8xl">

        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-105">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Users
            </a>
        </div>

        <!-- User Profile Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-10 mb-8 border border-white/50">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Avatar -->
                <div class="relative">
                    <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
                        {{ Str::substr($user->name, 0, 2) }}
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 {{ $user->status === 'active' ? 'bg-emerald-500' : ($user->status === 'pending' ? 'bg-orange-500' : 'bg-rose-500') }} rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                        @if($user->status === 'active')
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($user->status === 'pending')
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1zm4 0a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- User Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                        {{ $user->name }}
                    </h1>
                    <p class="text-xl text-gray-600 mt-2 flex items-center justify-center md:justify-start">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $user->email }}
                    </p>

                    <!-- Role & Status Badges -->
                    <div class="flex flex-wrap gap-3 mt-4 justify-center md:justify-start">
                        <!-- Role Badge -->
                        @if($user->role == 1)
                            @if($user->status === 'pending')
                                <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md animate-pulse">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Pending Admin
                                </span>
                            @else
                                <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    Administrator
                                </span>
                            @endif
                        @elseif($user->role == 2)
                            <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                                Seller
                            </span>
                        @else
                            <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-sky-500 to-cyan-600 text-white shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                                Buyer
                            </span>
                        @endif

                        <!-- Status Badge -->
                        <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold shadow-md
                            @if($user->status === 'active') bg-gradient-to-r from-emerald-400 to-teal-500 text-white
                            @elseif($user->status === 'pending') bg-gradient-to-r from-orange-400 to-red-500 text-white
                            @else bg-gradient-to-r from-red-400 to-rose-500 @endif">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                </div>

                <!-- Status Toggle (Only if not pending admin) -->
                @if(!($user->role == 1 && $user->status === 'pending'))
                    <div class="mt-6 md:mt-0">
                        <form action="{{ route('admin.users.status', $user) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                    class="px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-bold text-gray-700 shadow-lg focus:outline-none focus:ring-4 focus:ring-indigo-300 transition">
                                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}
                                        class="text-green-600 font-bold">Active</option>
                                <option value="blocked" {{ $user->status === 'blocked' ? 'selected' : '' }}
                                        class="text-red-600 font-bold">Blocked</option>
                            </select>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- PENDING ADMIN: APPROVE / REJECT BUTTONS -->
        @if($user->role == 1 && $user->status === 'pending')
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-300 rounded-3xl p-8 mb-8 shadow-xl">
                <h2 class="text-3xl font-extrabold text-amber-800 mb-4 flex items-center">
                    <svg class="w-10 h-10 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Admin Access Request
                </h2>
                <p class="text-lg text-amber-700 mb-6">This user has requested admin privileges. Review and take action:</p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <!-- APPROVE BUTTON -->
                    <form action="{{ route('admin.approve', $user) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                onclick="return confirm('Approve this user as Admin?')"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-lg rounded-2xl shadow-xl transition transform hover:scale-105">
                            <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve as Admin
                        </button>
                    </form>

                    <!-- REJECT BUTTON -->
                    <form action="{{ route('admin.reject', $user) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                onclick="return confirm('Reject this admin request? User will remain as Buyer.')"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold text-lg rounded-2xl shadow-xl transition transform hover:scale-105">
                            <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject Request
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- SELLER STORE SECTION -->
        @if($user->role == 2 && $user->store && $storeStats)
            <div class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-600 text-white rounded-3xl shadow-2xl p-10 mb-8 transform hover:scale-[1.01] transition">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-3xl font-extrabold flex items-center">
                            <svg class="w-10 h-10 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-4m-6 0H5"></path>
                            </svg>
                            {{ $user->store->name }}
                        </h2>
                        <p class="text-lg opacity-90 mt-1">Store Performance Overview</p>
                    </div>
                    <a href="{{ route('admin.stores.show', $user->store) }}" 
                       class="inline-flex items-center px-6 py-3 bg-white text-teal-600 font-bold rounded-xl shadow-lg hover:bg-gray-100 transition transform hover:scale-105">
                        View Full Store
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-5xl font-extrabold">{{ $storeStats['completed_orders'] }}</p>
                        <p class="text-lg opacity-90 mt-1">Completed Orders</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <p class="text-5xl font-extrabold">${{ number_format($storeStats['total_revenue'], 2) }}</p>
                        <p class="text-lg opacity-90 mt-1">Total Revenue</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.16c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.953c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.953a1 1 0 00-.364-1.118L2.317 9.38c-.783-.57-.38-1.81.588-1.81h4.16a1 1 0 00.95-.69l1.286-3.953z"/>
                            </svg>
                        </div>
                        @php
                            $avgRating = $user->store->products->pluck('reviews')->flatten()->avg('rating') ?? 0;
                        @endphp
                        <p class="text-5xl font-extrabold">{{ number_format($avgRating, 1) }}</p>
                        <p class="text-lg opacity-90 mt-1">Average Rating</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- BUYER ORDERS -->
        @if($user->role == 3 && $user->orders->count() > 0)
            <div class="bg-white rounded-3xl shadow-2xl p-10">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-8 flex items-center">
                    <svg class="w-9 h-9 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Recent Orders (as Buyer)
                </h2>
                <div class="space-y-6">
                    @foreach($user->orders->take(5) as $order)
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xl font-bold text-gray-800">Order #{{ $order->id }}</p>
                                    <p class="text-gray-600">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                                    <p class="text-sm text-indigo-600 mt-1">{{ $order->items->count() }} items</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-extrabold text-green-600">${{ number_format($order->total, 2) }}</p>
                                    <span class="inline-block px-4 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold mt-2">
                                        Completed
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection