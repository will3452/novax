<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
    ];

    public function branches () {
        return $this->belongsToMany(Branch::class, 'inventories', 'product_id', 'branch_id');
    }

    public function saleItems () {
        return $this->hasMany(SaleItem::class, 'product_id');
    }
}
