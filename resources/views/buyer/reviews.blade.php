@extends('layouts.app')

@section('title', 'My Reviews')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-indigo-600">My Reviews</h1>
        
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left">Product</th>
                    <th class="px-6 py-3 text-left">Rating</th>
                    <th class="px-6 py-3 text-left">Comment</th>
                    <th class="px-6 py-3 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews ?? [] as $review)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $review->product->name }}</td>
                        <td class="px-6 py-4">{{ $review->rating }}/5</td>
                        <td class="px-6 py-4">{{ $review->comment }}</td>
                        <td class="px-6 py-4">{{ $review->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection