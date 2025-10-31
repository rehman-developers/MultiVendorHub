@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <div class="bg-white rounded-2xl shadow-2xl p-8 relative overflow-hidden">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-indigo-700">Order #{{ $order->id }}</h1>
                <p class="text-gray-600">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
            </div>

            <div class="flex items-center space-x-4">
                <span class="px-6 py-2 rounded-full text-white font-bold text-sm
                    {{ $order->status == 'completed' ? 'bg-green-500' : ($order->status == 'pending' ? 'bg-yellow-500' : ($order->status == 'confirmed' ? 'bg-blue-500' : 'bg-red-500')) }}">
                    {{ ucfirst($order->status) }}
                </span>

                @if($order->status === 'pending')
                <button onclick="openEditModal()"
                        class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg transition shadow-lg transform hover:scale-105">
                    Edit Details
                </button>
                @endif
            </div>
        </div>

        {{-- Info Cards --}}
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-5 rounded-xl border border-gray-200">
                <h3 class="font-semibold text-gray-800 mb-2 flex items-center">Shipping Address</h3>
                <p class="text-gray-700 leading-relaxed">{{ $order->shipping_address }}</p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-5 rounded-xl border border-blue-200">
                <h3 class="font-semibold text-gray-800 mb-2 flex items-center">Payment Method</h3>
                <p class="font-bold text-blue-700">
                    {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Credit/Debit Card' }}
                </p>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-emerald-100 p-5 rounded-xl border border-green-200">
                <h3 class="font-semibold text-gray-800 mb-2 flex items-center">Payment Status</h3>
                <p class="font-bold text-lg 
                    {{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-orange-600' }}">
                    @if($order->payment_method == 'cod')
                        Cash on Delivery
                    @else
                        {{ $order->payment_status == 'paid' ? 'Paid' : 'Pending' }}
                    @endif
                </p>
            </div>
        </div>

        {{-- Order Items --}}
        <h3 class="text-xl font-bold mb-5 text-gray-800">Order Items</h3>

        <div class="space-y-4 mb-8">
            @foreach($order->items as $item)
            <div class="flex items-center justify-between bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl border border-gray-200 hover:shadow-md transition">
                <div class="flex items-center space-x-4">
                    <img src="{{ $item->product->image ?? asset('images/placeholder.jpg') }}"
                         alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $item->product->name }}</h4>
                        <p class="text-sm text-gray-600">Qty: <strong>{{ $item->quantity }}</strong></p>
                        <p class="text-xs text-gray-500">@ ${{ number_format($item->price, 2) }} each</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-indigo-600 text-lg">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </p>

                    {{-- REVIEW FORM - ONLY IF ORDER COMPLETED & NOT REVIEWED --}}
                    @if($order->status === 'completed')
                        @if(!\App\Models\Review::where('product_id', $item->product_id)->where('buyer_id', auth()->id())->exists())
                            <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="font-medium text-sm mb-2">Rate this product:</p>
                                <form action="{{ route('buyer.review.add', $item->product_id) }}" method="POST">
                                    @csrf
                                    <div class="flex space-x-1 mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                                                <span class="text-2xl text-gray-300 hover:text-yellow-500 transition">Star</span>
                                            </label>
                                        @endfor
                                    </div>
                                    <textarea name="comment" placeholder="Your feedback (optional)..." class="w-full text-sm border rounded p-2" rows="2"></textarea>
                                    <button type="submit" class="mt-2 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded text-sm font-medium hover:from-indigo-700 hover:to-purple-700 transition">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @else
                            <p class="text-green-600 text-sm mt-2 font-medium">Review Submitted</p>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="border-t-2 border-dashed border-gray-300 pt-6">
            <div class="flex justify-between items-center text-xl font-bold">
                <span class="text-gray-800">Total Amount</span>
                <span class="text-3xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                    ${{ number_format($order->total, 2) }}
                </span>
            </div>
        </div>

        {{-- Action Buttons --}}
        @if($order->status === 'pending')
            <div class="mt-8 space-y-3">
                @if($order->payment_method === 'cod')
                    <form action="{{ route('buyer.orders.confirm', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 rounded-xl transition shadow-lg transform hover:scale-105">
                            Confirm Order (Cash on Delivery)
                        </button>
                    </form>
                @else
                    <a href="{{ route('buyer.orders.pay', $order->id) }}"
                       class="block text-center w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 rounded-xl transition shadow-lg transform hover:scale-105">
                        Pay with Card - ${{ number_format($order->total, 2) }}
                    </a>
                @endif

                <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-bold py-4 rounded-xl transition shadow-lg transform hover:scale-105 mt-3"
                            onclick="return confirm('Cancel this order? Stock will be restored.')">
                        Cancel Order
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 transform transition-all animate-fade-in">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Update Order Details</h3>
            <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">Close</button>
        </div>
        <form action="{{ route('buyer.orders.update-details', $order->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Shipping Address</label>
                <textarea name="shipping_address" rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                          required>{{ old('shipping_address', $order->shipping_address) }}</textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Method</label>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-indigo-50 transition {{ old('payment_method', $order->payment_method) == 'cod' ? 'border-indigo-600 bg-indigo-50 ring-2 ring-indigo-500' : 'border-gray-300' }}">
                        <input type="radio" name="payment_method" value="cod" class="mr-3" {{ old('payment_method', $order->payment_method) == 'cod' ? 'checked' : '' }} required>
                        <div><p class="font-medium">Cash on Delivery</p></div>
                    </label>
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-indigo-50 transition {{ old('payment_method', $order->payment_method) == 'card' ? 'border-indigo-600 bg-indigo-50 ring-2 ring-indigo-500' : 'border-gray-300' }}">
                        <input type="radio" name="payment_method" value="card" class="mr-3" {{ old('payment_method', $order->payment_method) == 'card' ? 'checked' : '' }}>
                        <div><p class="font-medium">Credit/Debit Card</p></div>
                    </label>
                </div>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 rounded-lg transition">Cancel</button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 rounded-lg transition shadow-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal() { 
    document.getElementById('editModal').classList.remove('hidden'); 
    document.body.style.overflow = 'hidden'; 
}
function closeEditModal() { 
    document.getElementById('editModal').classList.add('hidden'); 
    document.body.style.overflow = 'auto'; 
}
window.addEventListener('click', e => { if (e.target.id === 'editModal') closeEditModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeEditModal(); });
</script>

<style>
@keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
.animate-fade-in { animation: fadeIn 0.3s ease-out; }
</style>
@endsection