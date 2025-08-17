<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Lukman Aji',
            'email' => 'lukman@example.com',
            'role' => 'Admin',
            'foto' => null,
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'nama' => 'Tina Sari',
            'email' => 'tina@example.com',
            'role' => 'User',
            'foto' => null,
            'password' => Hash::make('123456'),
        ]);
    }
}
