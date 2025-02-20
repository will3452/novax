<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'salable_id',
        'salable_type',
        'qty',
        'price',
    ];

    public function sale () {
        return $this->belongsTo(Sale::class);
    }

    public function salable() {
        return $this->morphTo('salable');
    }
}
