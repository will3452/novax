<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'curriculum_id',
        'course',
        'address',
        'mobile',
        'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function curriculum () {
        return $this->belongsTo(Curriculum::class);
    }
}
