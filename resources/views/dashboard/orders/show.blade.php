<x-layouts.app :title="__('Order Detail')">
    <div class="container mx-auto px-4 py-8">
        <!-- Header dengan nomor order dan status -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
                <p class="text-gray-600 mt-1">#{{ $order->order_number }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-full text-sm font-semibold 
                    @if($order->status === 'completed') bg-green-100 text-green-800
                    @elseif($order->status === 'waiting_verification') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-blue-100 text-blue-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
                <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</span>
            </div>
        </div>

        <!-- Card utama -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <!-- Informasi pelanggan dan pesanan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                <!-- Bagian kiri - Informasi pelanggan -->
                <div class="space-y-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Informasi Pelanggan</h2>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-700">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->shipping_email }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->shipping_phone }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-700 mb-1">Alamat Pengiriman</h3>
                                    <p class="text-gray-600">{{ $order->shipping_address }}</p>
                                    <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
                                </div>
                            </div>
                            
                            @if($order->notes)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-700 mb-1">Catatan</h3>
                                    <p class="text-gray-600">{{ $order->notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bagian kanan - Detail pesanan -->
                <div class="space-y-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Detail Pesanan</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($order->shippingMethod)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pengiriman ({{ $order->shippingMethod->name }})</span>
                                <span class="font-medium">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            
                            <div class="flex justify-between pt-3 border-t border-gray-100">
                                <span class="text-gray-800 font-semibold">Total</span>
                                <span class="text-gray-800 font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($order->payment_confirmation)
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="font-medium text-blue-800 mb-2">Informasi Pembayaran</h3>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <span class="text-gray-600">Bank Tujuan</span>
                            <span class="font-medium">{{ $order->payment_confirmation->bank_name }}</span>
                            
                            <span class="text-gray-600">Nama Pengirim</span>
                            <span class="font-medium">{{ $order->payment_confirmation->account_name }}</span>
                            
                            <span class="text-gray-600">Jumlah Transfer</span>
                            <span class="font-medium">Rp {{ number_format($order->payment_confirmation->transfer_amount, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ Storage::url($order->payment_confirmation->payment_proof) }}"
                           target="_blank" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 mt-3 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Bukti Transfer
                        </a>
                    </div>
                    @endif

                    @if($order->tracking_number)
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-medium text-green-800 mb-2">Informasi Pengiriman</h3>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Nomor Resi: {{ $order->tracking_number }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Daftar produk -->
            <div class="border-t border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Produk Dipesan</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="flex-shrink-0 w-16 h-16 rounded-md overflow-hidden border border-gray-200">
                            <img src="{{ $item->product->image_url? asset($item->product->image_url): asset('images/no-image.png') }}" class="rounded me-3" width="60" height="60" alt="{{ $item->product_name }}">
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="font-medium text-gray-800">{{ $item->product_name }}</h3>
                            @if($item->product_size)
                            <p class="text-sm text-gray-500">Ukuran: {{ $item->product_size }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                            <p class="font-medium mt-1">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tombol aksi -->
        <div class="flex flex-col sm:flex-row justify-end gap-3">
            <a href="{{ route('dashboard.orders.index') }}" 
               class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            @if(in_array($order->status, ['pending', 'processing', 'waiting_verification']))
            <form action="{{ route('dashboard.orders.update-status', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="completed">
                <button type="submit" 
                        class="px-5 py-2.5 rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Tandai Selesai
                </button>
            </form>
            @endif
        </div>
    </div>
</x-layouts.app>