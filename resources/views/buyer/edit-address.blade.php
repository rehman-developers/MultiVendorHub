@extends('layouts.app')

@section('title', 'Shipping & Payment')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center text-indigo-700 mb-8">Shipping & Payment Details</h1>

        <form action="{{ route('buyer.address.update') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Shipping Address</label>
                <textarea name="shipping_address" rows="4"
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('shipping_address') border-red-500 @enderror"
                          placeholder="House #, Street, City, Country..." required>{{ old('shipping_address', auth()->user()->shipping_address) }}</textarea>
                @error('shipping_address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Method</label>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-indigo-50 transition {{ old('payment_method', auth()->user()->payment_method) == 'cod' ? 'border-indigo-600 bg-indigo-50' : '' }}">
                        <input type="radio" name="payment_method" value="cod" class="mr-3" {{ old('payment_method', auth()->user()->payment_method) == 'cod' ? 'checked' : '' }} required>
                        <div>
                            <p class="font-medium">Cash on Delivery (COD)</p>
                            <p class="text-sm text-gray-600">Pay when you receive</p>
                        </div>
                    </label>

                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-indigo-50 transition {{ old('payment_method', auth()->user()->payment_method) == 'card' ? 'border-indigo-600 bg-indigo-50' : '' }}">
                        <input type="radio" name="payment_method" value="card" class="mr-3" {{ old('payment_method', auth()->user()->payment_method) == 'card' ? 'checked' : '' }}>
                        <div>
                            <p class="font-medium">Credit/Debit Card</p>
                            <p class="text-sm text-gray-600">Secure online payment</p>
                        </div>
                    </label>
                </div>
                @error('payment_method')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('buyer.cart') }}" class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 rounded-lg transition">
                    Back to Cart
                </a>
                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition">
                    Save & Continue
                </button>
            </div>
        </form>
    </div>
</div>
@endsection