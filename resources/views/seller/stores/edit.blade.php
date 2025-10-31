@extends('layouts.app')

@section('title', 'Edit Store')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-bold text-center text-indigo-700 mb-8">Edit Your Store</h1>

        <form action="{{ route('seller.stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Name</label>
                <input type="text" name="name" value="{{ old('name', $store->name) }}" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $store->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Logo (Optional)</label>
                @if($store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="Current Logo" class="w-32 h-32 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="logo" accept="image/*" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('logo') border-red-500 @enderror">
                @error('logo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 rounded-lg transition shadow-lg transform hover:scale-105">
                Update Store
            </button>
        </form>
    </div>
</div>
@endsection