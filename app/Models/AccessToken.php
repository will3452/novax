<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'key',
        'user_id',
        'channel',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    const CHANNEL_GCASH = 'GCASH';


    public function generateKey() {
        return Str::random(32);
    }
}
