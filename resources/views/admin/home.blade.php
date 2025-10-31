{{-- resources/views/admin/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Home')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6">
    <div class="container mx-auto max-w-7xl">

        <!-- Welcome Header -->
        <div class="bg-white rounded-2xl shadow-2xl p-10 mb-8 text-center">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-4">
                Welcome, Admin!
            </h1>
            <p class="text-xl text-gray-600">Manage your multi-vendor platform with ease.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white p-8 rounded-2xl shadow-xl text-center transform hover:scale-105 transition">
                <p class="text-5xl font-bold">{{ $totalStores }}</p>
                <p class="text-lg font-medium mt-2">Total Stores</p>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-8 rounded-2xl shadow-xl text-center transform hover:scale-105 transition">
                <p class="text-5xl font-bold">{{ $completedOrders }}</p>
                <p class="text-lg font-medium mt-2">Completed Orders</p>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-8 rounded-2xl shadow-xl text-center transform hover:scale-105 transition">
                <p class="text-5xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
                <p class="text-lg font-medium mt-2">Total Revenue</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition text-center">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6m5-10l-3-3m0 0l-3 3m3-3v10"></path>
                    </svg>
                </div>
                <p class="font-bold text-gray-800">Dashboard</p>
            </a>

            <a href="{{ route('admin.stores.index') }}" 
               class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-4m-6 0H5"></path>
                    </svg>
                </div>
                <p class="font-bold text-gray-800">View Stores</p>
            </a>

            <a href="{{ route('admin.dashboard') }}" 
               class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <p class="font-bold text-gray-800">Revenue</p>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <p class="font-bold text-gray-800">Manage Users</p>
            </a>
        </div>
    </div>
</div>
@endsection