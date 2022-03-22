<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'discount_rate',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
