<?php

namespace App\Models;

use App\Models\Traits\HasFeedback;
use App\Models\Traits\HasRoom;
use App\Models\Traits\HasRecords;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\HasStudentsOrParent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,
        HasStudentsOrParent,
        HasFactory,
        HasRoom,
        HasRecords,
        Notifiable,
        HasFeedback,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'year_level',
        'student_number',
        'phone',
        'type',
        'address',
    ];

    const TYPE_STUDENT = 'Student';
    const TYPE_TEACHER = 'Teacher';
    const TYPE_PARENT = 'Parent';
    const TYPE_PARTNER = 'Partner';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //student room
    public function classRoom()
    {
        return $this->hasOne(StudentRoom::class, 'student_id');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'user_id');
    }
}
