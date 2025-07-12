<x-layout>
    <x-slot name="title">Pembayaran Berhasil - Toko Helm AntiTilang</x-slot>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5 text-center">
                        <!-- Icon Sukses -->
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </div>
                        <!-- Judul -->
                        <h2 class="fw-bold mb-3">Pembayaran Berhasil Diproses!</h2>
                        <p class="lead mb-4">Terima kasih telah berbelanja di Toko Helm AntiTilang</p>
                        <!-- Detail Order -->
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body text-start">
                                <h5 class="card-title mb-3">Detail Pesanan</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nomor Order:</strong><br> {{ $order->order_number }}</p>
                                        <p><strong>Tanggal:</strong><br> {{ $order->created_at->format('d F Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Total Pembayaran:</strong><br> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                        @if($order->payment_confirmation)
                                            <p><strong>Metode Pembayaran:</strong><br> Transfer Bank {{ $order->payment_confirmation->bank_name }}</p>
                                            <p><strong>Tanggal Transfer:</strong><br> {{ \Carbon\Carbon::parse($order->payment_confirmation->transfer_date)->format('d F Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Daftar Produk -->
                        <div class="mb-4">
                            <h5 class="mb-3">Produk yang Dibeli:</h5>
                            <div class="list-group">
                                @foreach($order->items as $item)
                                    <div class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image_url? asset($item->product->image_url): asset('images/no-image.png') }}" class="rounded me-3" width="60" height="60" alt="{{ $item->product_name }}">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $item->product_name }}</h6>
                                                <small class="text-muted">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                            </div>
                                            <div class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Tombol Aksi -->
                        <div class="d-grid gap-2 d-md-block">
                            <a href="/" class="btn btn-outline-primary me-md-2">
                                <i class="bi bi-arrow-left"></i> Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>