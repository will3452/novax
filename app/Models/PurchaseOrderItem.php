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
        'qty',
        'cost',
    ];

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function purchaseOrder () {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
