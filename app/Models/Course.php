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

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'In-Active';

    public function scopeActive($q)
    {
        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            return $q->whereStatus(self::STATUS_ACTIVE);
        }

        return $q->whereStatus(self::STATUS_ACTIVE)->whereUserId(auth()->id());
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //students
    public function userCourses()
    {
        return $this->hasMany(UserCourse::class, 'course_id');
    }
}
