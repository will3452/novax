<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'category',
        'status',
    ];

    const STATUS_AVAILABLE = 'Available';
    const STATUS_NOT_AVAILABLE = 'Not Available';
}
