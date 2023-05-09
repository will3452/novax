<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxPayerAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_id',
        'taxpayer_name',
        'taxpayer_address',
        'taxpayer_city',
        'taxpayer_state',
        'taxpayer_zip',
    ];
}
