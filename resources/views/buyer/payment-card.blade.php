{{-- resources/views/buyer/payment-card.blade.php --}}
@extends('layouts.app')

@section('title', 'Pay with Card')

@section('content')
<div class="container mx-auto p-6 max-w-md">
    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-700">Complete Payment</h1>
            <p class="text-gray-600 mt-2">Order #{{ $order->id }}</p>
        </div>

        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl mb-6">
            <div class="flex justify-between text-lg">
                <span class="font-semibold">Total Amount</span>
                <span class="font-bold text-indigo-600">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <form action="{{ route('buyer.orders.pay.process', $order->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Card Number</label>
                <input type="text" placeholder="1234 5678 9012 3456" 
                       class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" 
                       value="4242 4242 4242 4242" readonly>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Expiry</label>
                    <input type="text" placeholder="MM/YY" value="12/34"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">CVC</label>
                    <input type="text" placeholder="123" value="123"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" readonly>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 rounded-xl transition shadow-lg transform hover:scale-105 mt-6">
                Pay ${{ number_format($order->total, 2) }}
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('buyer.orders.show', $order->id) }}" class="text-gray-600 hover:text-gray-800 text-sm">
                Back to Order
            </a>
        </div>
    </div>
</div>
@endsection