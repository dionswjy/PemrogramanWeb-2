<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart, Order, OrderItem, ShippingMethod, PaymentMethod, Province};
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'provinsi_id' => 'required|exists:provinces,id',
            'kode_pos' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'notes' => 'nullable|string|max:500'
        ]);

        $cart = Cart::with(['items.itemable'])
            ->where('user_id', Auth::guard('customer')->id())
            ->firstOrFail();

        $shippingMethod = ShippingMethod::findOrFail($validated['shipping_method_id']);
        $province = Province::findOrFail($validated['provinsi_id']);
        
        $subtotal = $cart->calculatedPriceByQuantity();
        $shippingCost = $shippingMethod->cost;
        $total = $subtotal + $shippingCost;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => Auth::guard('customer')->id(),
                'shipping_method_id' => $validated['shipping_method_id'],
                'payment_method_id' => $validated['payment_method_id'],
                'order_number' => 'ORD-' . now()->format('YmdHis') . Str::random(4),
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'pending',
                'customer_name' => $validated['nama_depan'] . ' ' . $validated['nama_belakang'],
                'shipping_address' => $validated['alamat'],
                'shipping_city' => $validated['kota'],
                'shipping_province' => $province->name,
                'shipping_postal_code' => $validated['kode_pos'],
                'shipping_phone' => $validated['telepon'],
                'shipping_email' => $validated['email'],
                'notes' => $validated['notes']
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->itemable->id,
                    'product_name' => $item->itemable->name,
                    'product_image' => $item->itemable->image_url,
                    'quantity' => $item->quantity,
                    'price' => $item->itemable->price,
                    'subtotal' => $item->itemable->price * $item->quantity
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return $this->handlePaymentRedirect($order, $validated['payment_method_id']);

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Checkout error: ' . $e->getMessage());
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    protected function handlePaymentRedirect($order, $paymentMethodId)
    {
        switch ($paymentMethodId) {
            case 1: // Transfer Bank
                return redirect()->route('payment.confirmation', $order->id)
                       ->with('info', 'Silakan upload bukti transfer');
            
            case 5: // COD
                return redirect()->route('order.success', $order->id)
                       ->with('success', 'Pesanan COD berhasil dibuat');
            
            default: // Payment Gateway
                return redirect()->route('payment.gateway', $order->id);
        }
    }
}