<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sos extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'message',
        'user_id',
        'lat',
        'lng',
        'status',
        'audio', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
