<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_type_id',
        'registration_number',
        'location',
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

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }
}
