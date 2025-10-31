@extends('layouts.app')

@section('title', 'Add Review')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center text-indigo-600">Add Review for {{ $product->name }}</h1>
        
        <form action="{{ route('buyer.reviews.add', $product->id) }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" min="1" max="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded transition duration-300">Submit Review</button>
        </form>
    </div>
@endsection