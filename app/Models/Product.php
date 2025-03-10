<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

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
        'category',
    ];

    public function searchableAs()
    {
        return 'products_index';
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public function brand () {
        return $this->belongsTo(Brand::class);
    }
}
