<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Struk;

class StrukSeeder extends Seeder
{
    public function run()
    {
        Struk::create([
            'header_struk' => '=== Coffe Addict ===',
            'footer_struk' => 'Terima kasih, datang kembali!',
        ]);
    }
}
