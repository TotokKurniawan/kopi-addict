<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            ['Cappuccino', 'drink', 25000],
            ['Nasi Goreng', 'food', 35000],
            ['Espresso', 'drink', 20000],
            ['Latte', 'drink', 28000],
            ['Mie Goreng', 'food', 30000],
            ['Sate Ayam', 'food', 40000],
            ['Teh Tarik', 'drink', 18000],
            ['Jus Alpukat', 'drink', 22000],
            ['Burger', 'food', 45000],
            ['Pizza', 'food', 60000],
            ['Americano', 'drink', 22000],
            ['Matcha Latte', 'drink', 32000],
            ['Ayam Geprek', 'food', 30000],
            ['Soto Ayam', 'food', 28000],
            ['Ramen', 'food', 50000],
            ['Smoothie Berry', 'drink', 35000],
            ['Kopi Tubruk', 'drink', 15000],
            ['Pancake', 'food', 25000],
            ['Cheesecake', 'food', 30000],
            ['Mojito', 'drink', 27000],
        ];

        foreach ($menus as $m) {
            Menu::create([
                'nama' => $m[0],
                'kategori' => $m[1],
                'harga' => $m[2],
                'foto' => null,
            ]);
        }
    }
}
