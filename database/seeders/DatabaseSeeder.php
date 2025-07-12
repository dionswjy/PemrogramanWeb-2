<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            ShippingMethodSeeder::class,
            PaymentMethodSeeder::class,
            // Tambahkan seeder lain di sini
            CategoriesSeeder::class,
            ProductSeeder::class,
        ]);
    }
}