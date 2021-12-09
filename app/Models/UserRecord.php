<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'position',
        'user_id',
        'record_id',
        'is_main',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }
}
