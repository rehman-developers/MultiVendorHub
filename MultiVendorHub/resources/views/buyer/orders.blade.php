{{-- resources/views/buyer/orders.blade.php --}}
@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto p-6 max-w-5xl">
    <h1 class="text-4xl font-bold text-center text-indigo-600 mb-10">My Orders</h1>

    @if($orders->isEmpty())
        <p class="text-center text-gray-600 py-8">No orders yet. <a href="{{ route('buyer.home') }}" class="text-indigo-600 hover:underline">Start shopping!</a></p>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Order #{{ $order->id }}</h3>
                        <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="px-4 py-1 rounded-full text-sm font-medium text-white
                        {{ $order->status == 'completed' ? 'bg-green-500' : ($order->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <p class="text-gray-600">
                        <strong>{{ $order->items->count() }}</strong> items
                    </p>
                    <div class="space-x-3">
                        <a href="{{ route('buyer.orders.show', $order->id) }}" class="text-indigo-600 hover:underline font-medium">
                            View Details
                        </a>
                        @if($order->status === 'pending')
                            <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline font-medium"
                                        onclick="return confirm('Cancel this order?')">
                                    Cancel
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection