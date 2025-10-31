<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCompleted;

class SellerDashboardController extends Controller
{
    /**
     * Seller Home Page (seller.home)
     */
    public function index()
    {
        $store = auth()->user()->store;

        // Agar store nahi hai to create karne bhejo
        if (!$store) {
            return redirect()->route('seller.stores.create')
                             ->with('error', 'Pehle apna store banayein.');
        }

        // Recent 5 products dikhane ke liye
        $recentProducts = $store->products()->latest()->limit(5)->get();

        return view('seller.home', compact('store', 'recentProducts'));
    }

    /**
     * Seller Dashboard Page (seller.dashboard)
     */
    public function dashboard()
    {
        $user = auth()->user();
        $store = $user->store;

        // Store nahi to create karne bhejo
        if (!$store) {
            return redirect()->route('seller.stores.create')
                             ->with('error', 'Pehle apna store banayein.');
        }

        // 1. Total Products
        $totalProducts = $store->products()->count();

        // 2. Total Sales (Only Completed Orders)
        $totalSales = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->whereIn('order_items.product_id', $store->products()->pluck('id'))
            ->sum(DB::raw('order_items.price * order_items.quantity'));

        // 3. Pending Orders Count (Exclude Cancelled)
        $pendingOrders = Order::whereIn('status', ['pending', 'confirmed'])
            ->whereHas('items.product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->count();

        // 4. Low Stock Products (< 10)
        $lowStockProducts = $store->products()->where('stock', '<', 10)->count();

        // 5. Recent Products (Last 5)
        $products = $store->products()->latest()->take(5)->get();

        // 6. NEW: Pending Orders List (Dashboard pe dikhane ke liye)
        $pendingOrdersList = Order::where('status', '!=', 'completed')
            ->where('status', '!=', 'cancelled')
            ->whereHas('items.product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->with('buyer','items.product')
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'totalProducts',
            'totalSales',
            'pendingOrders',
            'lowStockProducts',
            'products',
            'pendingOrdersList',
            'store'
        ));
    }

    /**
     * Orders List Page (seller.orders.index) – FIXED
     */
    public function orders()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('seller.stores.create')
                             ->with('error', 'Please create a store first.');
        }

        // FIXED: Use 'items' (not 'orderItems') + Exclude Cancelled
        $orders = Order::whereHas('items.product', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })
        ->where('status', '!=', 'cancelled') // HIDE CANCELLED ORDERS
        ->with(['buyer', 'items.product'])
        ->latest()
        ->paginate(15);

        return view('seller.orders.index', compact('orders'));
    }

    /**
     * Complete Order (Dashboard + Orders Page dono se use hoga)
     */
    public function completeOrder($orderId)
    {
        $store = auth()->user()->store;

        if (!$store) {
            return back()->with('error', 'Store not found.');
        }

        $order = Order::whereHas('items.product', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })
        ->where('status', '!=', 'cancelled')
        ->findOrFail($orderId);

        if ($order->status === 'completed') {
            return back()->with('error', 'order already completed..');
        }

        // Status update karo
        $order->update([
            'status' => 'completed',
            'payment_status' => $order->payment_method === 'cod' ? 'paid' : $order->payment_status
        ]);
        
        // Send email to buyer
        Mail::to($order->buyer->email)->send(new OrderCompleted($order));

        return back()->with('success', 'Order Successfully Completed.');
    }
}