<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'date',
        'cashier_id',
        'total_amount',
        'customer_id',
        'payment_method',
        'total_cost',
        'status',
        'type',
    ];
    protected $casts = [
        'date' => 'date',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function cashier () {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function customer () {
        return $this->belongsTo(Customer::class);
    }

    public function items () {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
}
