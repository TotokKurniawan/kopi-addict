<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = ['transaksi_id', 'menu_id', 'qty', 'subtotal'];

    // Relasi ke Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
