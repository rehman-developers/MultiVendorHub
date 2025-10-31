@extends('layouts.app')

@section('title', 'My Store')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto">
    {{-- Back Button (Top-Left) --}}
    <div class="mb-6">
        <a href="{{ route('seller.dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
             Dashboard
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-8 text-center text-indigo-600">My Store</h1>

    <div class="flex justify-end mb-6">
        @if (!$store)
            <a href="{{ route('seller.stores.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded transition">
                Create Store
            </a>
        @else
            <a href="{{ route('seller.stores.edit', $store->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded mr-2 transition">
                Edit Store
            </a>
            <form action="{{ route('seller.stores.destroy', $store->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Are you sure you want to delete your store?')"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition">
                    Delete Store
                </button>
            </form>
        @endif
    </div>

    @if (!$store)
        <div class="text-center py-12">
            <p class="text-gray-600 text-lg">You don't have a store yet. Create one to start selling!</p>
        </div>
    @else
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $store->name }}</h2>
            <p class="text-gray-600">{{ $store->description ?? 'No description provided.' }}</p>
        </div>

        <div class="text-center space-x-4">
            <a href="{{ route('seller.stores.show', $store->id) }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded transition">
                View Store Details
            </a>
            <a href="{{ route('seller.products.index') }}"
               class="inline-block bg-purple-600 hover:bg-purple-700 text-white py-2 px-6 rounded transition">
                Manage Products
            </a>
        </div>
    @endif
</div>
@endsection