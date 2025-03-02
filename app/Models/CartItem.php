<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'branch_id',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function product () {
        return $this->belongsTo(Product::class);
    }
}
