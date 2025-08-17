<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'role',
        'foto',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Meja (satu user bisa punya banyak meja)
    public function meja()
    {
        return $this->hasMany(Meja::class);
    }

    // Relasi ke Transaksi (satu user bisa punya banyak transaksi)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
