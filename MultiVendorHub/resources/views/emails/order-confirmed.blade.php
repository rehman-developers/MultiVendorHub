<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { background: #4f46e5; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
        .btn { display: inline-block; padding: 12px 24px; background: #10b981; color: white; text-decoration: none; border-radius: 5px; margin: 15px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f9fafb; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Order Confirmed!</h1>
    </div>
    <div class="content">
        <p>Hi <strong>{{ $order->buyer->name }}</strong>,</p>
        <p>Your order has been successfully placed. Here are the details:</p>

        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        <p><strong>Payment Status:</strong>
            <span style="color: {{ $order->payment_status === 'paid' ? 'green' : 'orange' }}; font-weight: bold;">
                {{ $order->payment_status === 'paid' ? 'Paid' : ($order->payment_method === 'cod' ? 'Cash on Delivery' : 'Pending') }}
            </span>
        </p>

        <h3>Items Ordered:</h3>
        <table>
            <tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </table>

        <p><strong>Shipping Address:</strong><br>{{ $order->shipping_address }}</p>

        <a href="{{ route('buyer.orders.show', $order->id) }}" class="btn">View Order Details</a>

        <p>We will notify you once your order is shipped.</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} MULTI-VENDOR-HUB. All rights reserved.
    </div>
</div>
</body>
</html>