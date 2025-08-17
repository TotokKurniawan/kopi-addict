<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil semua seeder yang sudah dibuat
        $this->call([
            UserSeeder::class,
            TokoSeeder::class,
            StrukSeeder::class,
            MenuSeeder::class,
            MejaSeeder::class,
            TransaksiSeeder::class,
            DetailTransaksiSeeder::class,
        ]);
    }
}
