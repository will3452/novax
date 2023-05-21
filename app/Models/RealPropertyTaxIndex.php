<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealPropertyTaxIndex extends Model
{
    use HasFactory;

    protected $fillable = [
        'lgu',
        'classification_id',
        'assessed_value',
        'tax_rate',
        'tax_index',
        'total_tax',
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
}
