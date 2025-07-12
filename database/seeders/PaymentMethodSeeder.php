<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $methods = [
            [
                'name' => 'Transfer Bank',
                'code' => 'bank_transfer',
                'description' => 'Transfer melalui ATM/Internet Banking/Mobile Banking',
                'instructions' => 'Silakan transfer ke rekening berikut:\nBank: BCA\nNo. Rek: 1234567890\nAtas Nama: Toko Helm Anda',
                'is_active' => true
            ],
            [
                'name' => 'GoPay',
                'code' => 'gopay',
                'description' => 'Pembayaran melalui GoPay',
                'instructions' => 'Pilih pembayaran GoPay di halaman checkout',
                'is_active' => true
            ],
            [
                'name' => 'OVO',
                'code' => 'ovo',
                'description' => 'Pembayaran melalui OVO',
                'instructions' => 'Pilih pembayaran OVO di halaman checkout',
                'is_active' => true
            ],
            [
                'name' => 'DANA',
                'code' => 'dana',
                'description' => 'Pembayaran melalui DANA',
                'instructions' => 'Pilih pembayaran DANA di halaman checkout',
                'is_active' => true
            ],
            [
                'name' => 'COD (Cash on Delivery)',
                'code' => 'cod',
                'description' => 'Bayar ketika barang diterima',
                'instructions' => 'Pembayaran dilakukan saat kurir mengantar pesanan',
                'is_active' => true,
                'additional_fee' => 10000 // Biaya tambahan untuk COD
            ],
            [
                'name' => 'Indomaret',
                'code' => 'indomaret',
                'description' => 'Pembayaran melalui gerai Indomaret',
                'instructions' => 'Anda akan mendapatkan kode pembayaran setelah checkout',
                'is_active' => true
            ]
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}