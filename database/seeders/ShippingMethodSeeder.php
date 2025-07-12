<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    public function run()
    {
        $methods = [
            [
                'name' => 'JNE - REG',
                'description' => 'Layanan reguler JNE',
                'cost' => 15000,
                'estimated_delivery' => '2-3 hari kerja',
                'is_active' => true
            ],
            [
                'name' => 'J&T - Express',
                'description' => 'Layanan cepat J&T',
                'cost' => 25000,
                'estimated_delivery' => '1-2 hari kerja',
                'is_active' => true
            ],
            // Tambahkan metode lainnya
        ];

        foreach ($methods as $method) {
            ShippingMethod::create($method);
        }
    }
}