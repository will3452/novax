<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'bag',
        'kg',
        'price',
        'current_qty',
        'opo',
        'tp',
        'tu',
        'td',
        'dl',
    ];

    public function purchaseOrders () {
        return $this->hasMany(IngredientPurchaseOrder::class, 'ingredient_id');
    }

    public function inventories () {
        return $this->hasMany(IngredientInventory::class, 'ingredient_id');
    }

    public function getQuantityAttribute() {
        $totalUsage = $this->inventories()->whereType('USAGE')->sum('quantity');
        $totalPurchase = $this->inventories()->whereType('PURCHASE')->sum('quantity');
        return $totalPurchase - $totalUsage;
    }
}
