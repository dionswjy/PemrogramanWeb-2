<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'payment_confirmation'])
                      ->latest()
                      ->get();
        
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {

        $order->load([
            'user',
            'items.product', 
            'payment_confirmation',
            'shippingMethod'
        ]);

        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:waiting_verification,processing,completed,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    /**
     * Mark order as shipped.
     */
    public function markAsShipped(Request $request, Order $order)
    {
        $validated = $request->validate([
            'tracking_number' => 'required|string',
            'shipping_carrier' => 'required|string'
        ]);

        $order->update([
            'status' => 'shipped',
            'tracking_number' => $validated['tracking_number'],
            'shipping_carrier' => $validated['shipping_carrier'],
            'shipped_at' => now()
        ]);

        return back()->with('success', 'Pesanan berhasil ditandai sebagai dikirim');
    }
}