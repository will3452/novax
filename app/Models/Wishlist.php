<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'consumer_id',
    ];

    protected $with = [
        'product',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'consumer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
