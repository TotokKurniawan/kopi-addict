<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Toko extends Model
{
    use HasFactory;

    protected $fillable = ['nama_toko', 'logo_toko', 'alamat_toko', 'pajak'];
}
