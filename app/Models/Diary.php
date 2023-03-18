<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'title',
        'body',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
