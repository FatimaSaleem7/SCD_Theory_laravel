<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email', // Changed to required for tracking
            'customer_address' => 'required|string',
            'cart' => 'required|array',
            'total' => 'required|numeric'
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'total_amount' => $request->total,
            'payment_method' => 'COD',
            'status' => 'pending'
        ]);

        foreach ($request->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'medicine_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // EXACT CHANGE: Save this order ID to the user's session
        $placedOrders = session()->get('placed_orders', []);
        $placedOrders[] = $order->id;
        session()->put('placed_orders', $placedOrders);

        return response()->json([
            'success' => true,
            'order_id' => $order->id
        ]);
    }

    public function history(Request $request)
    {
        // Check if user is searching by email
        $searchEmail = $request->query('email');
        
        if ($searchEmail) {
            // Find all orders matching that email
            $orders = Order::where('customer_email', $searchEmail)
                ->with('items.medicine')
                ->latest()
                ->get();
        } else {
            // Fallback: Show only orders from current session
            $orderIds = session()->get('placed_orders', []);
            $orders = Order::whereIn('id', $orderIds)
                ->with('items.medicine')
                ->latest()
                ->get();
        }

        return view('pages.order_history', compact('orders', 'searchEmail'));
    }
}