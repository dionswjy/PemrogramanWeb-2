<x-layout>
    <x-slot name="title">Konfirmasi Pembayaran - Toko Helm AntiTilang</x-slot>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-credit-card me-2"></i>Konfirmasi Pembayaran
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Pesanan #{{ $order->order_number }}</h5>
                            <p class="mb-0">Total yang harus dibayar: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></p>
                        </div>

                        <!-- Payment Generation Section -->
                        <div class="mb-4 p-3 border rounded">
                            <h5 class="mb-3">Generate Pembayaran</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="selected_bank" class="form-label">Pilih Bank</label>
                                    <select class="form-select" id="selected_bank" required>
                                        <option value="">Pilih Bank</option>
                                        <option value="BCA">BCA</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BRI">BRI</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="account_owner" class="form-label">Nama Pemilik Rekening</label>
                                    <input type="text" class="form-control" id="account_owner" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_amount" class="form-label">Jumlah Transfer</label>
                                    <input type="number" class="form-control" id="payment_amount" value="{{ $order->total }}" required>
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <button id="generateBtn" class="btn btn-primary w-100">
                                        <i class="bi bi-credit-card me-2"></i>Generate Pembayaran
                                    </button>
                                </div>
                            </div>

                            <!-- Payment Details (will be shown after generation) -->
                            <div id="paymentDetails" class="mt-3 p-3 bg-light rounded" style="display: none;">
                                <h6 class="fw-bold">Detail Pembayaran</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Bank Tujuan:</strong></p>
                                        <p id="display_bank" class="mb-2"></p>
                                        
                                        <p class="mb-1"><strong>Nomor Rekening:</strong></p>
                                        <p id="display_account_number" class="mb-2"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Atas Nama:</strong></p>
                                        <p id="display_account_name" class="mb-2"></p>
                                        
                                        <p class="mb-1"><strong>Jumlah Transfer:</strong></p>
                                        <p id="display_amount" class="mb-2"></p>
                                    </div>
                                </div>
                                <p class="text-muted small mt-2">Silahkan transfer sesuai dengan detail di atas, kemudian unggah bukti transfer di bawah.</p>
                            </div>
                        </div>

                        <!-- Payment Confirmation Form -->
                        <form action="{{ route('payment.submit_confirmation', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="bank_name" name="bank_name">
                            <input type="hidden" id="account_name" name="account_name">
                            <input type="hidden" id="transfer_amount" name="transfer_amount" value="{{ $order->total }}">
                            
                            <div class="mb-3">
                                <label for="transfer_date" class="form-label">Tanggal Transfer</label>
                                <input type="date" class="form-control" id="transfer_date" name="transfer_date" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="payment_proof" class="form-label">Bukti Transfer</label>
                                <input type="file" class="form-control" id="payment_proof" name="payment_proof" accept="image/*,.pdf" required>
                                <small class="text-muted">Format: JPG, PNG, atau PDF (maks. 2MB)</small>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Kirim Konfirmasi
                                </button>
                                <a href="{{ route('order.success', $order->id) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateBtn = document.getElementById('generateBtn');
            const paymentDetails = document.getElementById('paymentDetails');
            
            // Bank account information (you can customize this)
            const bankAccounts = {
                'BCA': { number: '1234567890', name: 'Toko Helm AntiTilang' },
                'Mandiri': { number: '0987654321', name: 'Toko Helm AntiTilang' },
                'BNI': { number: '1122334455', name: 'Toko Helm AntiTilang' },
                'BRI': { number: '5566778899', name: 'Toko Helm AntiTilang' }
            };

            generateBtn.addEventListener('click', function() {
                const selectedBank = document.getElementById('selected_bank').value;
                const accountOwner = document.getElementById('account_owner').value;
                const paymentAmount = document.getElementById('payment_amount').value;
                
                if (!selectedBank || !accountOwner || !paymentAmount) {
                    alert('Harap lengkapi semua field untuk generate pembayaran');
                    return;
                }
                
                // Display payment details
                document.getElementById('display_bank').textContent = selectedBank;
                document.getElementById('display_account_number').textContent = bankAccounts[selectedBank].number;
                document.getElementById('display_account_name').textContent = bankAccounts[selectedBank].name;
                document.getElementById('display_amount').textContent = 'Rp ' + parseInt(paymentAmount).toLocaleString('id-ID');
                
                // Set values for form submission
                document.getElementById('bank_name').value = selectedBank;
                document.getElementById('account_name').value = accountOwner;
                document.getElementById('transfer_amount').value = paymentAmount;
                
                // Show payment details
                paymentDetails.style.display = 'block';
            });
        });
    </script>
</x-layout>