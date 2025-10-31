@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto p-6 max-w-5xl">

    {{-- Back to Shop --}}
    <div class="mb-6">
        <a href="{{ route('buyer.home') }}"
           class="inline-flex items-center px-5 py-2.5 bg-gray-700 hover:bg-gray-800 text-white font-medium rounded-lg transition shadow">
            Continue Shopping
        </a>
    </div>

    <h1 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-10">
        Your Shopping Cart
    </h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg mb-6 shadow-sm flex items-center">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="text-center py-16 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl">
            <p class="text-2xl font-semibold text-gray-700 mb-4">Your cart is empty!</p>
            <a href="{{ route('buyer.home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition">
                Start Shopping
            </a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">Product</th>
                            <th class="px-6 py-4 text-center">Price</th>
                            <th class="px-6 py-4 text-center">Quantity</th>
                            <th class="px-6 py-4 text-center">Subtotal</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                        <tr class="hover:bg-gray-50 transition" id="cart-row-{{ $item->id }}">
                            <td class="px-6 py-4 flex items-center space-x-4">
                                <img src="{{ $item->product->image ?? asset('images/placeholder.jpg') }}"
                                     alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg shadow">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500">Stock: {{ $item->product->stock }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-medium">${{ number_format($item->product->price, 2) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="updateQuantity({{ $item->id }}, -1)"
                                            class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition">
                                        -
                                    </button>
                                    <input type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           class="w-16 text-center border rounded-md py-1" id="qty-{{ $item->id }}"
                                           onchange="updateQuantity({{ $item->id }}, this.value - {{ $item->quantity }})">
                                    <button onclick="updateQuantity({{ $item->id }}, 1)"
                                            class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition">
                                        +
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-indigo-600"
                                id="subtotal-{{ $item->id }}">
                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('buyer.cart.remove', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Address & Payment Form --}}
            <div class="p-6 bg-gradient-to-r from-indigo-50 to-purple-50 border-t">
                <form action="{{ route('buyer.checkout') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-2">Shipping Address</label>
                        <textarea name="shipping_address" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" rows="3" placeholder="Enter your full address"></textarea>
                        @error('shipping_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-2">Payment Method</label>
                        <select name="payment_method" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="cod">Cash on Delivery</option>
                            <option value="card">Credit/Debit Card</option>
                        </select>
                        @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t">
                        <p class="text-2xl font-bold text-gray-800">Total:</p>
                        <p class="text-3xl font-extrabold text-indigo-600" id="cart-total">
                            ${{ number_format($total, 2) }}
                        </p>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 rounded-lg text-center shadow-lg transition transform hover:scale-105">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
function updateQuantity(itemId, change) {
    const input = document.getElementById('qty-' + itemId);
    let newQty = parseInt(input.value) + change;

    if (newQty < 1) newQty = 1;
    if (newQty > parseInt(input.max)) {
        alert('Only ' + input.max + ' in stock!');
        return;
    }

    input.value = newQty;

    fetch(`{{ url('buyer/cart') }}/${itemId}/update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('subtotal-' + itemId).textContent = '$' + data.subtotal;
            document.getElementById('cart-total').textContent = '$' + data.total;
        } else {
            alert(data.error);
            location.reload();
        }
    })
    .catch(() => {
        alert('Error updating cart.');
        location.reload();
    });
}
</script>
@endsection