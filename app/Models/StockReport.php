<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockReport extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stockTakes()
    {
        return $this->hasMany(StockTake::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
