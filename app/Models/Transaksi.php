<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meja_id',
        'total',
        'status',
        'pembayaran',
        'bayar',
        'kembalian',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Meja
    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    // Relasi ke DetailTransaksi
    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
