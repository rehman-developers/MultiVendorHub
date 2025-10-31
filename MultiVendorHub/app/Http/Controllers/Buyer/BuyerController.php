<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('store')
        ->where('is_active', true)
        ->where('stock', '>', 0);

        // Search by keyword (name or description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }else{
            $search = '';
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $category_id = $request->category_id;
            $query->where('category_id', $category_id);
        }else{
           $category_id = '';
        }

        $products = $query->paginate(12); // Paginate for better UX
        $categories = Category::all(); // All categories for dropdown

        // Get cart item count
        $cartCount = auth()->user()->cartItems()->sum('quantity');

        return view('buyer.index', compact('products', 'categories', 'search', 'category_id','cartCount'));
    }

    public function dashboard()
    {
        $cartItems = auth()->user()->cartItems;
        $orders = auth()->user()->orders;
        $orderCount = $orders->count();
        $wishlistCount = 0; // Placeholder if you have wishlist
        $reviewCount = auth()->user()->reviews->count();
        $recentOrders = auth()->user()->orders()->latest()->limit(5)->get(); // Fixed: Use query builder with ()
        $reviews = auth()->user()->reviews()->with('product')->limit(5)->get();

        return view('buyer.dashboard', compact('cartItems', 'orders', 'orderCount', 'wishlistCount', 'reviewCount', 'recentOrders', 'reviews'));
    }

   public function addToCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);

        $request->validate([
            'quantity' => 'integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        Cart::updateOrCreate(
            ['buyer_id' => auth()->id(), 'product_id' => $productId],
            ['quantity' => $quantity]
        );

        // Option 1: Stay on same page (current behavior - good for adding more items)
        return redirect()->back()->with('success', 'Product added to cart!');

        // Option 2: Redirect to cart page (uncomment if you want this)
        // return redirect()->route('buyer.cart')->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('buyer.cart', compact('cartItems', 'total'));
    }
 
    public function updateCart(Request $request, $itemId)
    {
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = Cart::findOrFail($itemId);

    if ($cartItem->buyer_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $product = $cartItem->product;
    if ($request->quantity > $product->stock) {
        return response()->json(['error' => 'Only ' . $product->stock . ' in stock!'], 400);
    }

    $cartItem->update(['quantity' => $request->quantity]);

    $newSubtotal = $product->price * $request->quantity;
    $newTotal = auth()->user()->cartItems()->with('product')->get()->sum(fn($i) => $i->product->price * $i->quantity);

    return response()->json([
        'success' => true,
        'subtotal' => number_format($newSubtotal, 2),
        'total' => number_format($newTotal, 2),
    ]);
    }


    public function removeFromCart($itemId)
    {
    $cartItem = Cart::findOrFail($itemId);

    if ($cartItem->buyer_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $cartItem->delete();

    return redirect()->back()->with('success', 'Item removed from cart!');
    }

   public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method'   => 'required|in:cod,card',
        ]);

        $cartItems = auth()->user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('buyer.cart')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);

        $paymentStatus = $request->payment_method === 'cod' ? 'pending' : 'unpaid';

        $order = Order::create([
            'buyer_id'         => auth()->id(),
            'total'            => $total,
            'shipping_address' => $request->shipping_address,
            'payment_method'   => $request->payment_method,
            'status'           => 'pending',
            'payment_status'   => $paymentStatus,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'    => $order->id,
                'product_id'  => $item->product_id,
                'quantity'    => $item->quantity,
                'price'       => $item->product->price,
            ]);
            $item->product->decrement('stock', $item->quantity);
            $item->delete();
        }

        // Send Email
        Mail::to(auth()->user()->email)->send(new OrderConfirmed($order));

        return redirect()->route('buyer.orders')->with('success', 'Order placed! Confirmation email sent.');
    }
 
    public function updateOrderDetails(Request $request, $orderId)
    {
    $order = auth()->user()->orders()->findOrFail($orderId);

    $request->validate([
        'shipping_address' => 'required|string|max:500',
        'payment_method' => 'required|in:cod,card',
    ]);

    $order->update($request->only(['shipping_address', 'payment_method']));

    return back()->with('success', 'Order details updated successfully!');
    }

    public function cancelOrder($orderId)
    {
    $order = auth()->user()->orders()->findOrFail($orderId);

    if ($order->status !== 'pending') {
        return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
    }

    // Restore stock
    foreach ($order->items as $item) {
        $item->product->increment('stock', $item->quantity);
    }

    $order->update(['status' => 'cancelled']);

    return redirect()->back()->with('success', 'Order cancelled successfully!');
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->with('items.product')->get(); // Eager load for details if needed
        return view('buyer.orders', compact('orders'));
    }
    public function showOrder($orderId)
    {
    $order = auth()->user()->orders()->with('items.product')->findOrFail($orderId);

    return view('buyer.order-show', compact('order'));
    }

   // Allow review only if order is completed
    public function addReview(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'nullable|string|max:1000',
            'rating'  => 'required|integer|between:1,5',
        ]);

        $buyerId = auth()->id();

        // Check if buyer purchased & order is completed
        $hasPurchased = Order::where('buyer_id', $buyerId)
            ->where('status', 'completed')
            ->whereHas('items', fn($q) => $q->where('product_id', $productId))
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products from completed orders.');
        }

        // Prevent duplicate review
        if (Review::where('product_id', $productId)->where('buyer_id', $buyerId)->exists()) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'product_id' => $productId,
            'buyer_id'   => $buyerId,
            'comment'    => $request->comment,
            'rating'     => $request->rating,
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted.');
    }

    public function reviews()
    {
        $reviews = auth()->user()->reviews()->with('product')->get();
        return view('buyer.reviews', compact('reviews'));
    }

    public function editAddress()
    {
    return view('buyer.edit-address');
    }

    public function updateAddress(Request $request)
    {
    $request->validate([
        'shipping_address' => 'required|string|max:500',
        'payment_method' => 'required|in:cod,card',
    ]);

    $user = auth()->user();
    $user->update([
        'shipping_address' => $request->shipping_address,
        'payment_method' => $request->payment_method,
    ]);

    // REFRESH USER IN SESSION
    auth()->setUser($user->fresh());

    return redirect()->route('buyer.cart')->with('success', 'Shipping & payment details saved!');
    }
    public function confirmOrder($orderId)
    {
    $order = auth()->user()->orders()->where('status', 'pending')->findOrFail($orderId);

    if ($order->payment_method === 'cod') {
        $order->update([
            'status' => 'confirmed',
            'payment_status' => 'pending' // COD = pending until delivery
        ]);
    } else {
        return redirect()->route('buyer.orders.pay', $orderId);
    }

    // Send Email
    Mail::to($order->buyer->email)->send(new OrderConfirmed($order));

    return back()->with('success', 'Order confirmed! Email sent.');
    }

    public function payWithCard($orderId)
    {
        $order = auth()->user()->orders()->where('status', 'pending')->findOrFail($orderId);

        if ($order->payment_method !== 'card') {
            return back()->with('error', 'Invalid payment method.');
        }

        // Simulate Stripe Payment (Replace with real Stripe later)
        session(['pending_order_id' => $orderId]);

        return view('buyer.payment-card', compact('order'));
    }

    public function processCardPayment(Request $request, $orderId)
    {
    $order = Order::findOrFail($orderId);

    // Simulate successful payment
    $order->update([
        'status' => 'confirmed',
        'payment_status' => 'paid'
    ]);

    // Send Email
    Mail::to($order->buyer->email)->send(new OrderConfirmed($order));

    session()->forget('pending_order_id');

    return redirect()->route('buyer.orders.show', $orderId)
                     ->with('success', 'Payment successful! Order confirmed.');
    }
}