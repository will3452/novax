<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'expired_at',
        'code',
        'user_id',
    ];

    protected $casts = [
        'expired_at' => 'date'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function item () {
        return $this->belongsTo(Item::class);
    }
}
