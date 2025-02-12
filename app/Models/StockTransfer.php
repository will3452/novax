<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'from_branch_id',
        'from_warehouse_id',
        'to_branch_id',
        'to_warehouse_id',
        'quantity',
        'initiated_by_id',
        'transfer_date',
    ];

    protected $casts = [
        'transfer_date' => 'date',
    ];

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function fromBranch () {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }


    public function fromWarehouse() {
        return $this->belongsTo(Warehouse::class, 'from_warehouse_id');
    }

    public function toBranch () {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }


    public function toWarehouse() {
        return $this->belongsTo(Warehouse::class, 'to_warehouse_id');
    }

    public function initiatedBy () {
        return $this->belongsTo(User::class, 'initiated_by_id');
    }

}
