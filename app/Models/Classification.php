<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'classification',
    ];

    public function realPropertyTaxIndeces()
    {
        return $this->hasMany(RealPropertyTaxIndex::class);
    }
}
