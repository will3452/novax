<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'name',
        'image',
        'brand_id',
        'sku',
        'price',
        'description',
        'cost',
    ];

    public function searchableAs()
    {
        return 'products_index';
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public function brand () {
        return $this->belongsTo(Brand::class);
    }
}
