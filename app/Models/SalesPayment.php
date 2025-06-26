<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_id',
        'branch_id',
        'method',
        'type', // partial or full
        'cash',
        'change',
        'amount',
        'cashier_id',
    ];

    public function cashier () {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function sales() {
        return $this->belongsTo(Sale::class, 'sales_id');
    }

    public function branch () {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
