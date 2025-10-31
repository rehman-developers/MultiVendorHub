@extends('layouts.app')

@section('title', 'My Products')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-indigo-600">My Products</h1>

        {{-- Back to Store Button --}}
        <a href="{{ route('seller.stores.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
             Store
        </a>
    </div>

    {{-- Add Product + Filter --}}
    <div class="flex flex-col sm:flex-row justify-between mb-6 space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ route('seller.products.create') }}"
           class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
            Add New Product
        </a>

        <form method="GET" action="{{ route('seller.products.index') }}" class="flex items-center space-x-2">
            <label for="category_id" class="text-gray-700 font-medium">Filter:</label>
            <select name="category_id" id="category_id"
                    class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                            {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                Filter
            </button>
        </form>
    </div>

    {{-- Products Table --}}
    @if($products->isEmpty())
        <p class="text-center text-gray-600">
            No products found.
            @if(request('category_id')) Try selecting a different category. @endif
        </p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                 class="w-16 h-16 object-cover rounded-md shadow-sm">
                        </td>
                        <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->category->name ?? '—' }}</td>
                        <td class="px-6 py-4">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4 text-center space-x-3">
                            <a href="{{ route('seller.products.edit', $product->id) }}"
                               class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>

                            <form action="{{ route('seller.products.destroy', $product->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this product?')"
                                        class="text-red-600 hover:text-red-800 font-medium">
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
@endsection