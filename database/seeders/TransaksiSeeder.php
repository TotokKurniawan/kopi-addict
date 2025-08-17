<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        Transaksi::create([
            'user_id' => 1,
            'meja_id' => 1,
            'total' => 25000,
            'status' => 'lunas',
            'pembayaran' => 'cash',
            'bayar' => 30000,
            'kembalian' => 5000,
        ]);

        Transaksi::create([
            'user_id' => 2,
            'meja_id' => 2,
            'total' => 35000,
            'status' => 'belum lunas',
            'pembayaran' => 'qris',
            'bayar' => null,
            'kembalian' => null,
        ]);
    }
}
