<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan sementara foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Province::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $provinces = [
            ['id' => 11, 'name' => 'ACEH', 'code' => 'ACE'],
            ['id' => 12, 'name' => 'SUMATERA UTARA', 'code' => 'SUMUT'],
            ['id' => 13, 'name' => 'SUMATERA BARAT', 'code' => 'SUMBAR'],
            ['id' => 14, 'name' => 'RIAU', 'code' => 'RIAU'],
            ['id' => 15, 'name' => 'JAMBI', 'code' => 'JAMBI'],
            ['id' => 16, 'name' => 'SUMATERA SELATAN', 'code' => 'SUMSEL'],
            ['id' => 17, 'name' => 'BENGKULU', 'code' => 'BENGKULU'],
            ['id' => 18, 'name' => 'LAMPUNG', 'code' => 'LAMPUNG'],
            ['id' => 19, 'name' => 'KEPULAUAN BANGKA BELITUNG', 'code' => 'BABEL'],
            ['id' => 21, 'name' => 'KEPULAUAN RIAU', 'code' => 'KEPRI'],
            ['id' => 31, 'name' => 'DKI JAKARTA', 'code' => 'DKI'],
            ['id' => 32, 'name' => 'JAWA BARAT', 'code' => 'JABAR'],
            ['id' => 33, 'name' => 'JAWA TENGAH', 'code' => 'JATENG'],
            ['id' => 34, 'name' => 'DI YOGYAKARTA', 'code' => 'DIY'],
            ['id' => 35, 'name' => 'JAWA TIMUR', 'code' => 'JATIM'],
            ['id' => 36, 'name' => 'BANTEN', 'code' => 'BANTEN'],
            ['id' => 51, 'name' => 'BALI', 'code' => 'BALI'],
            ['id' => 52, 'name' => 'NUSA TENGGARA BARAT', 'code' => 'NTB'],
            ['id' => 53, 'name' => 'NUSA TENGGARA TIMUR', 'code' => 'NTT'],
            ['id' => 61, 'name' => 'KALIMANTAN BARAT', 'code' => 'KALBAR'],
            ['id' => 62, 'name' => 'KALIMANTAN TENGAH', 'code' => 'KALTENG'],
            ['id' => 63, 'name' => 'KALIMANTAN SELATAN', 'code' => 'KALSEL'],
            ['id' => 64, 'name' => 'KALIMANTAN TIMUR', 'code' => 'KALTIM'],
            ['id' => 65, 'name' => 'KALIMANTAN UTARA', 'code' => 'KALTARA'],
            ['id' => 71, 'name' => 'SULAWESI UTARA', 'code' => 'SULUT'],
            ['id' => 72, 'name' => 'SULAWESI TENGAH', 'code' => 'SULTENG'],
            ['id' => 73, 'name' => 'SULAWESI SELATAN', 'code' => 'SULSEL'],
            ['id' => 74, 'name' => 'SULAWESI TENGGARA', 'code' => 'SULTRA'],
            ['id' => 75, 'name' => 'GORONTALO', 'code' => 'GORONTALO'],
            ['id' => 76, 'name' => 'SULAWESI BARAT', 'code' => 'SULBAR'],
            ['id' => 81, 'name' => 'MALUKU', 'code' => 'MALUKU'],
            ['id' => 82, 'name' => 'MALUKU UTARA', 'code' => 'MALUT'],
            ['id' => 91, 'name' => 'PAPUA BARAT', 'code' => 'PABAR'],
            ['id' => 94, 'name' => 'PAPUA', 'code' => 'PAPUA'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}