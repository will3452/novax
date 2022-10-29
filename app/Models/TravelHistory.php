<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'lng',
        'lat',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
