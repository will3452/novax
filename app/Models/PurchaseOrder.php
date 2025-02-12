<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'supplier_id',
        'order_date',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function supplier () {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrderItems () {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }

    public function delivery () {
        return $this->hasOne(Delivery::class, 'purchase_order_id');
    }
}
