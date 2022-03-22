<?php

namespace App\Models;

use App\Models\Traits\HasInventories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasInventories;

    protected $fillable = [
        'description',
        'price',
        'category',
        'UoM',
        'notes',
        'sku', // stock-keeping unit
    ];

    public function promos()
    {
        return $this->belongsToMany(Promo::class);
    }

    public function promo()
    {
        return $this->promos()->latest()->first();
    }
}
