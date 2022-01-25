<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'user_id',//instructor
        'status', //closed | open
    ];

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'In-Active';

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //students
    public function userCourses()
    {
        return $this->hasMany(UserCourse::class, 'user_id');
    }
}
