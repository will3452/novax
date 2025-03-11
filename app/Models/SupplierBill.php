<?php

namespace App\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'po_no',
        'amount_due',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date'
    ];

    public function supplier () {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function payments () {
        return $this->hasMany(SupplierPayment::class, 'supplier_bill_id');
    }
}
