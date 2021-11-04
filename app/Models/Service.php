<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    const STATUS_AVAILABLE = 'available';
    const STATUS_NOT_AVAILABLE = 'not_available';
    use HasFactory;
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
