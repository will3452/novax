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

    public function ownerStore()
    {
        return $this->belongsTo(User::class, 'store_id');
    }
}
