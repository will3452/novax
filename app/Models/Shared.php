<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'message',
        'confirmed_at',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    protected $casts = ['confirmed_at' => 'datetime'];
}
