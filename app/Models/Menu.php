<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kategori', 'harga', 'foto'];

    // Relasi ke DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
