@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center text-indigo-600">Checkout</h1>
        
        <form action="{{ route('buyer.orders.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-2xl font-bold mb-4">Billing Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Payment Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                            <input type="text" name="card_number" id="card_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="expiry" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                                <input type="text" name="expiry" id="expiry" placeholder="MM/YY" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                <input type="text" name="cvv" id="cvv" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t pt-6">
                <h2 class="text-2xl font-bold mb-4">Order Summary</h2>
                @foreach ($cartItems ?? [] as $item)
                    <div class="flex justify-between mb-2">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <span>${{ number_format($item->subtotal, 2) }}</span>
                    </div>
                @endforeach
                <div class="flex justify-between mb-2">
                    <span>Shipping</span>
                    <span>$10.00</span>
                </div>
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>${{ number_format(($total ?? 0) + 10, 2) }}</span>
                </div>
            </div>
            <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded transition duration-300">Place Order</button>
        </form>
    </div>
@endsection