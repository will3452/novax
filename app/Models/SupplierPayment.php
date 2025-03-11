<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_bill_id',
        'payment_method',
        'amount_paid',
        'payment_date',
        'check_number',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function supplierBill () {
        return $this->belongsTo(SupplierBill::class, 'supplier_bill_id');
    }
}
