<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'nama' => 'Cappuccino',
            'kategori' => 'drink',
            'harga' => 25000,
            'foto' => null,
        ]);

        Menu::create([
            'nama' => 'Nasi Goreng',
            'kategori' => 'food',
            'harga' => 35000,
            'foto' => null,
        ]);
    }
}
