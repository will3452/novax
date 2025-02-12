<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'delivery_date',
        'delivered_by',
        'confirmation_status',
    ];

    protected $casts = [
        'delivery_date' => 'date',
    ];

    public function purchaseOrder () {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
