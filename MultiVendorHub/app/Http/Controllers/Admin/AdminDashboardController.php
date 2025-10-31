<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Admin Dashboard (Main Page)
     */
    public function index()
    {
        // GLOBAL STATS
        $totalUsers = User::count();
        $totalSellers = User::where('role', 2)->count();
        $totalStores = Store::count();

        // CORRECT: Total completed orders
        $completedOrders = Order::where('status', 'completed')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        // STORES WITH CORRECT COMPLETED ORDERS
        $stores = Store::with('user')->get()->map(function ($store) {
            $store->completed_orders_count = Order::where('status', 'completed')
                ->whereHas('items.product', fn($q) => $q->where('store_id', $store->id))
                ->distinct('id')
                ->count('id');

            $reviews = $store->products()->with('reviews')->get()->pluck('reviews')->flatten();
            $store->avg_rating = $reviews->avg('rating') ? round($reviews->avg('rating'), 1) : 0;
            $store->reviews_count = $reviews->count();

            $store->total_revenue = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('products.store_id', $store->id)
                ->where('orders.status', 'completed')
                ->sum(DB::raw('order_items.price * order_items.quantity'));

            return $store;
        });

        $recentCompletedOrders = Order::where('status', 'completed')
            ->with(['buyer', 'items.product.store'])
            ->latest()
            ->take(3)
            ->get();

        $pendingAdmins = User::where('role', 'admin')->where('status', 'pending')->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalSellers', 'totalStores',
            'completedOrders', 'totalRevenue', 'stores',
            'recentCompletedOrders', 'pendingAdmins'
        ));
    }

    /**
     * Admin Home Page (Welcome) – NOW SHOWS DATA
     */
    public function home()
    {
        $totalStores = Store::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        // Pass data to blade
        return view('admin.home', compact('totalStores', 'completedOrders', 'totalRevenue'));
    }
}