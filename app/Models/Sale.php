<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'cashier_id',
        'customer_id',
        'sale_date',
        'total_amount',
        'payment_method',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function cashier () {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function customer () {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function saleItems () {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }

    protected $casts = [
        'sale_date' => 'date',
    ];
}
