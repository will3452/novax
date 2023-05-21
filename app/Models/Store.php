<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'store_type_id',
        'location',
        'store_owner',
        'contact',
        'gross_sales',
        'expenses',
        'net_income',
        'taxable_income',
        'tax_rate',
        'total_tax',
        'tax_payment_status',
        'due_date',
    ];

    public function storeType()
    {
        return $this->belongsTo(StoreType::class);
    }
}
