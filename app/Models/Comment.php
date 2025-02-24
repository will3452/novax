<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'group_id',
        'value',
        'reply_to_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
