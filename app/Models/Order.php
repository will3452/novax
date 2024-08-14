<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'total_amount',
        'status', // PENDING, DONE, CANCELLED
        'mop', // EWALLET, BANK, OVER-THE-COUNTER
        'pop', 
        'user_id', 
    ];

    public function user () {
        return $this->belongsTo(User::class); 
    }

    public function products () {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('qty'); 
    }
}
