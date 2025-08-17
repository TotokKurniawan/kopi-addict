<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Struk extends Model
{
    use HasFactory;

    protected $fillable = ['header_struk', 'footer_struk'];
}
