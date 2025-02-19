<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'branch_id',
        'date',
        'status',
        'total_cost',
    ];

    public function supplier () {
        return $this->belongsTo(Supplier::class);
    }

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function items () {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }

    protected $casts = [
        'date' => 'date',
    ];
}
