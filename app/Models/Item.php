<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'file',
        'size',
        'type',
        'user_id',
        'key',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
