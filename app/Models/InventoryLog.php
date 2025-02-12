<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'product_id',
        'branch_id',
        'warehouse_id',
        'old_quantity',
        'new_quantity',
        'change_amount',
        'change_type',
        'change_by_id',
        'reference',
    ];

    public function inventory () {
        return $this->belongsTo(Inventory::class);
    }

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function warehouse () {
        return $this->belongsTo(Warehouse::class);
    }

    public function changeBy() {
        return $this->belongsTo(User::class, 'change_by_id');
    }
}
