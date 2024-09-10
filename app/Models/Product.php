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
    ]; 

    public function inventories () {
        return $this->hasMany(ProductInventory::class, 'product_id');
    }

    public function getQuantityAttribute() {
        $adjustments =  $this->inventories()->whereType('ADJUSTMENT')->sum('quantity'); 
        $orders =  $this->inventories()->whereType('ORDER')->sum('quantity'); 
        return $adjustments - $orders; 
    }
}
