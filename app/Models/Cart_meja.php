<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_meja extends Model
{
    protected $table = 'cart_mejas';
    protected $fillable = ['meja_id', 'menu_id', 'qty', 'harga'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
