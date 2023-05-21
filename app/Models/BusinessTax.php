<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'lgu',
        'business_type_id',
        'gross_sales',
        'tax_rate',
        'total_tax',
    ];

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }
}
