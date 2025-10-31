<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of users with correct role logic
     * role: 1 = Admin, 2 = Seller, 3 = Buyer (default)
     */
    public function index()
    {
        $users = User::with('store')
            ->orderByRaw("
                CASE 
                    WHEN role = 1 AND status = 'pending' THEN 1
                    WHEN role = 1 THEN 2
                    WHEN role = 2 THEN 3
                    ELSE 4 
                END
            ")
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user with correct stats
     */
    public function show(User $user)
    {
        // Load relationships
        $user->load(['store.products.reviews', 'orders' => fn($q) => $q->where('status', 'completed')]);

        $storeStats = null;

        // ONLY FOR SELLERS (role = 2)
        if ($user->role == 2 && $user->store) {
            $store = $user->store;

            // Count unique completed orders from this store
            $completedOrdersCount = Order::where('status', 'completed')
                ->whereHas('items.product', fn($q) => $q->where('store_id', $store->id))
                ->count();

            // Total revenue from completed orders
            $totalRevenue = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('products.store_id', $store->id)
                ->where('orders.status', 'completed')
                ->sum(DB::raw('order_items.price * order_items.quantity'));

            $storeStats = [
                'completed_orders' => $completedOrdersCount,
                'total_revenue' => $totalRevenue
            ];
        }

        return view('admin.users.show', compact('user', 'storeStats'));
    }

    /**
     * Update user status (active/blocked)
     */
    public function updateStatus(User $user, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,blocked'
        ]);

        $user->update(['status' => $request->status]);

        return back()->with('success', 'User status updated successfully!');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy(User $user)
    {
        // Prevent deleting any admin (role = 1)
        if ($user->role == 1) {
            return back()->with('error', 'Cannot delete an admin user!');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    // Add these methods to AdminUserController

public function approve(User $user)
{
    if ($user->role != 1 || $user->status !== 'pending') {
        return back()->with('error', 'Invalid request!');
    }
    

    $user->update(['status' => 'active']);

    return back()->with('success', 'Admin approved successfully!');
}

public function reject(User $user)
{
    if ($user->role != 1 || $user->status !== 'pending') {
        return back()->with('error', 'Invalid request!');
    }

    $user->update([
        'status' => 'active',
        'role' => 3
    ]);

    return back()->with('success', 'Admin request rejected. User is now a Buyer.');
    }
}