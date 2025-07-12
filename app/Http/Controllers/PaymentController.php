<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman sukses pembayaran
     */
    public function success(Order $order)
    {
        // Verifikasi bahwa order milik customer yang login
        if ($order->user_id != Auth::guard('customer')->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini');
        }

        // Load relasi yang diperlukan
        $order->load([
            'items',
            'paymentMethod',
            'shippingMethod',
            'user' => function($query) {
                $query->with(['province', 'city']);
            }
        ]);

        // Hitung estimasi tanggal diterima (hari kerja)
        $estimatedDeliveryDate = now()
            ->addWeekdays($order->shippingMethod->estimated_days ?? 3)
            ->format('l, j F Y');

        return view('web.success', [
            'order' => $order,
            'estimatedDeliveryDate' => $estimatedDeliveryDate
        ]);
    }

    /**
     * Menangani notifikasi callback dari payment gateway
     */
    public function handleNotification(Request $request)
    {
        $payload = $request->all();
        
        // Verifikasi signature (contoh untuk Midtrans)
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash('sha512', 
            $payload['order_id'] . 
            $payload['status_code'] . 
            $payload['gross_amount'] . 
            $serverKey
        );
        
        if ($hashed != $payload['signature_key']) {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 403);
        }

        // Proses update status order
        $order = Order::where('order_number', $payload['order_id'])->firstOrFail();
        
        switch ($payload['transaction_status']) {
            case 'capture':
            case 'settlement':
                $order->update(['status' => 'paid']);
                break;
                
            case 'pending':
                $order->update(['status' => 'pending']);
                break;
                
            case 'deny':
            case 'expire':
            case 'cancel':
                $order->update(['status' => 'failed']);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Menampilkan halaman konfirmasi pembayaran manual
     */
    public function showConfirmationForm($orderId)
    {
        $order = Order::where('user_id', Auth::guard('customer')->id())
                    ->findOrFail($orderId);

        return view('web.payment_confirmation', compact('order'));
    }

    /**
     * Menangani submit konfirmasi pembayaran manual
     */
    
    public function confirmPayment(Request $request, $orderId)
    {
        $request->validate([
            'payment_proof' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
            'bank_name' => 'required',
            'account_name' => 'required',
            'transfer_amount' => 'required|numeric',
            'transfer_date' => 'required|date'
        ]);

        $order = Order::where('user_id', Auth::guard('customer')->id())
            ->findOrFail($orderId);

        // Simpan bukti pembayaran
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Simpan informasi pembayaran
        $order->payment_confirmation()->create([
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'transfer_amount' => $request->transfer_amount,
            'transfer_date' => $request->transfer_date,
            'payment_proof' => $path,
        ]);

        // Update status order
        $order->update([
            'status' => 'waiting_verification',
        ]);

        return redirect()->route('order.success', $order->id)
            ->with('success', 'Bukti pembayaran berhasil diupload. Pesanan akan segera kami proses.');
    }

}