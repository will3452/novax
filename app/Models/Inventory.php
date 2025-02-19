<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'branch_id',
        'qty',
        'reorder_point',
    ];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    public function product () {
        return $this->belongsTo(Product::class);
    }
}
