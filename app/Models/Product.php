<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'name',
        'description',
        'image',
        'category',
        'price',
        'quantity',
    ];

    protected $with = [
        'storeOwner',
    ];

    public function storeOwner()
    {
        return $this->belongsTo(User::class, 'store_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'product_id');
    }

    public function getFeedbacks( $limit = 5)
    {
        return $this->feedbacks()->limit($limit)->get();
    }
}
