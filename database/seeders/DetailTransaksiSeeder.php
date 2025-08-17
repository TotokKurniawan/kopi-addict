<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;

class DetailTransaksiSeeder extends Seeder
{
    public function run()
    {
        DetailTransaksi::create([
            'transaksi_id' => 1,
            'menu_id' => 1,
            'qty' => 1,
            'subtotal' => 25000,
        ]);

        DetailTransaksi::create([
            'transaksi_id' => 2,
            'menu_id' => 2,
            'qty' => 1,
            'subtotal' => 35000,
        ]);
    }
}
