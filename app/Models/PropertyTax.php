<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', // ID,
        'location',
        'owner',
        'property_type_id',
        'assessed_value',
        'tax_rate',
        'effective_tax_rate',
        'total_tax',
        'tax_payment_status',
        'due_date',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }
}
