<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'teaching_load_id', // section
    ];

    public function teachingLoad()
    {
        return $this->belongsTo(TeachingLoad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
