<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;

class MejaSeeder extends Seeder
{
    public function run()
    {
        Meja::create([
            'nomor_meja' => '1',
            'status' => 'kosong',
        ]);

        Meja::create([
            'nomor_meja' => '2',
            'status' => 'aktif',
        ]);
        Meja::create([
            'nomor_meja' => '3',
            'status' => 'aktif',
        ]);
    }
}
