<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function warehouses() {
        return $this->hasMany(Warehouse::class, 'branch_id');
    }

    public function inventories () {
        return $this->hasMany(Inventory::class, 'branch_id');
    }

    public function products () {
        return $this->belongsToMany(Product::class, 'inventories', 'branch_id', 'product_id');
    }

    public function sales () {
        return $this->hasMany(Sale::class, 'branch_id');
    }
}
