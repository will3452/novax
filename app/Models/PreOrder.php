<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'reference',
        'status',
        'pickup_date',
        'payable',
    ];

    public function items () {
        return $this->hasMany(PreOrderItem::class, 'pre_order_id');
    }

    protected $casts = [
        'pickup_date' => 'date',
        'customer' => 'json',
    ];
}
