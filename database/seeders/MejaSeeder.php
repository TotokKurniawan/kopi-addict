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
            'nama_reservasi' => null,
            'status' => 'tersedia',
        ]);

        Meja::create([
            'nomor_meja' => '2',
            'nama_reservasi' => 'Malik',
            'status' => 'sudahdipesan',
        ]);
        Meja::create([
            'nomor_meja' => '3',
            'nama_reservasi' => 'Siti',
            'status' => 'sedangdigunakan',
        ]);
    }
}
