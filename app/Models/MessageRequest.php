<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'faculty_id',
    ];

    public function faculty () {
        return $this->belongsTo(Faculty::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
