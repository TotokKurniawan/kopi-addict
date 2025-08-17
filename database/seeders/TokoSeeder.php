<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Toko;

class TokoSeeder extends Seeder
{
    public function run()
    {
        Toko::create([
            'nama_toko' => 'Coffe Addict',
            'logo_toko' => null,
            'alamat_toko' => 'Jl. Merdeka No.1',
            'pajak' => 10,
        ]);

        Toko::create([
            'nama_toko' => 'Java Coffee',
            'logo_toko' => null,
            'alamat_toko' => 'Jl. Sudirman No.2',
            'pajak' => 12,
        ]);
    }
}
