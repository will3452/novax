<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
        'used_at',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
