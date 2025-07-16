<x-layout>
    <x-slot name="title">Checkout Pembayaran - Toko Helm Anda</x-slot>
    
    <div class="container my-5">
        <h1 class="mb-4">Checkout Pembayaran</h1>
        
        @if($cart && count($cart->items))
        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
            @csrf
            
            <!-- Notifikasi -->
            @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
            @endif
            
            <div class="row">
                <!-- Informasi Pengiriman & Pembayaran -->
                <div class="col-lg-8">
                    <!-- Informasi Pengiriman -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-truck me-2"></i>Informasi Pengiriman
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_depan" class="form-label">Nama Depan*</label>
                                    <input type="text" class="form-control" id="nama_depan" name="nama_depan" required 
                                            value="{{ auth()->guard('customer')->user()->first_name ?? old('nama_depan') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_belakang" class="form-label">Nama Belakang*</label>
                                    <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" required 
                                            value="{{ auth()->guard('customer')->user()->last_name ?? old('nama_belakang') }}">
                                </div>
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat Lengkap*</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ auth()->guard('customer')->user()->address ?? old('alamat') }}</textarea>
                                    <small class="text-muted">Contoh: Jl. Merdeka No. 123, Gedung A, Lantai 2</small>
                                </div>
                                <div class="col-md-4">
                                    <label for="kota" class="form-label">Kota/Kabupaten*</label>
                                    <input type="text" class="form-control" id="kota" name="kota" required 
                                            value="{{ auth()->guard('customer')->user()->city ?? old('kota') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="provinsi" class="form-label">Provinsi*</label>
                                    <select class="form-select" id="provinsi" name="provinsi_id" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" 
                                            {{ (auth()->guard('customer')->user()->province_id ?? old('provinsi_id')) == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="kode_pos" class="form-label">Kode Pos*</label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" required 
                                            value="{{ auth()->guard('customer')->user()->postal_code ?? old('kode_pos') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Nomor Telepon*</label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon" required 
                                            value="{{ auth()->guard('customer')->user()->phone ?? old('telepon') }}">
                                    <small class="text-muted">Contoh: 081234567890</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email" required 
                                            value="{{ auth()->guard('customer')->user()->email ?? old('email') }}">
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">Catatan (Opsional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                                    <small class="text-muted">Contoh: Warna helm hitam, ukuran L</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metode Pengiriman -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-truck me-2"></i>Metode Pengiriman
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach($shippingMethods as $method)
                                <label class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input me-3" type="radio" 
                                                name="shipping_method_id" 
                                                value="{{ $method->id }}" 
                                                {{ (old('shipping_method_id') == $method->id || $loop->first) ? 'checked' : '' }}
                                                data-cost="{{ $method->cost }}"
                                                required>
                                        <div>
                                            <h6 class="mb-1">{{ $method->name }}</h6>
                                            <small class="text-muted">{{ $method->estimated_delivery }}</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Rp {{ number_format($method->cost, 0, ',', '.') }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metode Pembayaran -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-credit-card me-2"></i>Metode Pembayaran
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach($paymentMethods as $method)
                                <label class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input me-3" type="radio" 
                                                name="payment_method_id" 
                                                value="{{ $method->id }}" 
                                                {{ (old('payment_method_id') == $method->id || $loop->first) ? 'checked' : '' }}
                                                required>
                                        <div>
                                            <h6 class="mb-1">{{ $method->name }}</h6>
                                            @if($method->description)
                                            <small class="text-muted">{{ $method->description }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ringkasan Pesanan -->
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-receipt me-2"></i>Ringkasan Pesanan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                @foreach($cart->items as $item)
                                <div class="d-flex mb-3">
                                    <img src="{{ $item->itemable->image_url 
                                            ? asset('storage/' . ltrim($item->itemable->image_url, '/')) 
                                            : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                                            class="rounded me-3" width="60" height="60" 
                                            alt="{{ $item->itemable->name }}"
                                            style="object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="my-0">{{ $item->itemable->name }}</h6>
                                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                        @if($item->itemable->size)
                                        <small class="d-block text-muted">Ukuran: {{ $item->itemable->size }}</small>
                                        @endif
                                    </div>
                                    <span class="text-muted">Rp {{ number_format($item->itemable->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                                @endforeach
                            </div>
                            
                            <hr>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($cart->calculatedPriceByQuantity(), 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim</span>
                                    <span id="shipping-cost">Rp {{ number_format($shippingMethods->first()->cost ?? 0, 0, ',', '.') }}</span>
                                </div>
                                @if($cart->coupon)
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span>Diskon</span>
                                    <span>- Rp {{ number_format($cart->discount_amount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                                <span>Total</span>
                                <span id="total-price">Rp {{ number_format($cart->calculatedPriceByQuantity() + ($shippingMethods->first()->cost ?? 0), 0, ',', '.') }}</span>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" id="submit-btn">
                                <span id="button-text">Bayar Sekarang</span>
                                <div id="spinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                            
                            <p class="text-muted small mt-3">
                                Dengan mengklik "Bayar Sekarang", Anda menyetujui 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Syarat & Ketentuan</a> 
                                serta <a href="#">Kebijakan Privasi</a> kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Modal Syarat & Ketentuan -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Syarat & Ketentuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('web.partials.terms_conditions')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            // Update shipping cost and total
            document.querySelectorAll('input[name="shipping_method_id"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const cost = parseFloat(this.getAttribute('data-cost'));
                    const subtotal = {{ $cart->calculatedPriceByQuantity() }};
                    const discount = {{ $cart->discount_amount ?? 0 }};
                    const total = subtotal + cost - discount;
                    
                    // Format dengan Intl.NumberFormat
                    const formatter = new Intl.NumberFormat('id-ID');
                    
                    document.getElementById('shipping-cost').textContent = 'Rp ' + formatter.format(cost);
                    document.getElementById('total-price').textContent = 'Rp ' + formatter.format(total);
                });
            });
            
            // Handle form submission
            document.getElementById('checkout-form').addEventListener('submit', function() {
                const btn = document.getElementById('submit-btn');
                const btnText = document.getElementById('button-text');
                const spinner = document.getElementById('spinner');
                
                btn.disabled = true;
                btnText.textContent = 'Memproses...';
                spinner.classList.remove('d-none');
            });
        </script>
        @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Keranjang belanja Anda kosong. Silakan <a href="{{ route('products.index') }}" class="alert-link">tambahkan produk</a> terlebih dahulu.
        </div>
        @endif
    </div>
</x-layout>