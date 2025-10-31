{{-- resources/views/emails/order-completed.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Order Completed</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background: #10b981; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .btn { display: inline-block; background: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f9fafb; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Your Order is Completed!</h1>
    </div>
    <div class="content">
        <p>Hi <strong>{{ $order->buyer->name }}</strong>,</p>
        <p>Your order <strong>#{{ $order->id }}</strong> has been successfully completed by the seller!</p>

        <p><strong>Details:</strong></p>
        <table>
            <tr><th>Order ID</th><td>#{{ $order->id }}</td></tr>
            <tr><th>Total</th><td>${{ number_format($order->total, 2) }}</td></tr>
            <tr><th>Status</th><td><span style="color: green; font-weight: bold;">Completed</span></td></tr>
            <tr><th>Shipping Address</th><td>{{ $order->shipping_address }}</td></tr>
        </table>

        <p><strong>Next Steps:</strong></p>
        <ul>
            <li>Your order is now shipped or ready for pickup</li>
            <li>Track your order in your dashboard</li>
            <li><strong>Leave a review</strong> to help other buyers!</li>
        </ul>

        <a href="{{ route('buyer.orders.show', $order->id) }}" class="btn">View Order Details</a>
    </div>
    <div style="text-align: center; padding: 20px; color: #666; font-size: 12px;">
        © {{ date('Y') }} MULTIVENDORHUB. All rights reserved.
    </div>
</div>
</body>
</html>