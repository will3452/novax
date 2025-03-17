<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'branch_address',
        'is_cash_sales',
        'is_charge_sales',
        'customer_name',
        'customer_tin',
        'customer_address',
        'total_sales',
        'total_amount_due',
        'sale_id',
        'branch_id',
        'items',
        'cashier',
        'type',// Sales or Service
    ];

    public function sale () {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function branch () {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    protected $casts = [
        'items' => 'json',
    ];
}
