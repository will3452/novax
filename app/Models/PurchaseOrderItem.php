<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'unit_cost',
        'sub_total',
    ];

    public function purchaseOrder () {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    public function product () {
        return $this->belongsTo(Product::class);
    }
}
