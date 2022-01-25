<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'study',
        'school_id',
        'type',
        'picture',
    ];

    const TYPE_STUDENT = 'Student';
    const TYPE_INSTRUCTOR = 'Instructor';

    const TYPE_OPTIONS = [
        self::TYPE_INSTRUCTOR => self::TYPE_INSTRUCTOR,
        self::TYPE_STUDENT => self::TYPE_STUDENT,
    ];

    // scopes
    public function scopeInstructors($query)
    {
        return $query->whereType(self::TYPE_INSTRUCTOR);
    }

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
}
