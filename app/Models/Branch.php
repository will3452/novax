<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'branch_course', 'branch_id', 'course_id');
    }
}
