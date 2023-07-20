<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'causes',
        'symptoms',
        'treatments',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
