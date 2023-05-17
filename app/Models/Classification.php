<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'classification',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
