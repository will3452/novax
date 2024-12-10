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
        'description',
        'uom',
        'category',
        'price',
        'qty_sell',
        'amount_sell',
        'ci', // current inventory
    ];

    public function inventories () {
        return $this->hasMany(ProductInventory::class, 'product_id');
    }

    public function preOrders () {
        return $this->belongsToMany(PreOrder::class, 'pre_order_items', 'product_id', 'pre_order_id');
    }

    public function orders () {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
    }

    // public function getQuantityAttribute() {
    //     $adjustments =  $this->inventories()->whereType('ADJUSTMENT')->sum('quantity');
    //     $orders =  $this->inventories()->whereType('ORDER')->sum('quantity');
    //     return $adjustments - $orders;
    // }
}
