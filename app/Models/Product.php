<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'brand_id',
        'sku',
        'price',
        'description',
        'cost',
    ];

    public function brand () {
        return $this->belongsTo(Brand::class);
    }
}
