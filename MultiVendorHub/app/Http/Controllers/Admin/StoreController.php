<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with(['user'])->get()->map(function ($store) {

            $store->completed_orders_count = \App\Models\Order::where('status', 'completed')
                ->whereHas('items.product', fn($q) => $q->where('store_id', $store->id))
                ->count();

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

        return view('admin.stores.index', compact('stores'));
    }

    public function show(Store $store)
    {
        // LOAD USER + REVIEWS
        $store->load(['user', 'products.reviews']);

        $completedOrders = $store->products()
            ->with('reviews')
            ->withCount([
                'orderItems as completed_orders_count' => function ($query) {
                    $query->whereHas('order', function ($q) {
                        $q->where('status', 'completed');
                    });
                }
            ])
            ->get();

        // Total revenue from COMPLETED only
        $totalRevenue = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.store_id', $store->id)
            ->where('orders.status', 'completed')
            ->sum(DB::raw('order_items.price * order_items.quantity'));

        return view('admin.stores.show', compact('store', 'completedOrders', 'totalRevenue'));
    }
}