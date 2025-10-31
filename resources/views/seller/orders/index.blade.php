@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-indigo-700">Orders</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white text-left text-sm">
                <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-4 font-bold">Order ID</th>
                        <th class="px-6 py-4 font-bold">Buyer</th>
                        <th class="px-6 py-4 font-bold">Total</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold">Payment</th>
                        <th class="px-6 py-4 font-bold text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">#{{ $order->id }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold">{{ $order->buyer->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->buyer->email ?? '' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-indigo-600">
                                ${{ number_format($order->total, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->payment_method == 'cod')
                                    <span class="text-orange-600 font-medium">Cash on Delivery</span>
                                @else
                                    <span class="text-green-600 font-medium">
                                        {{ $order->payment_status == 'paid' ? 'Paid' : 'Pending' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                    <form action="{{ route('seller.orders.complete', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition transform hover:scale-105 shadow-md"
                                                onclick="return confirm('Complete this Order?')">
                                            Complete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-xs font-medium">Done</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-lg">No Orders Found</p>
                                <p class="text-sm">When buyers place orders, they will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection