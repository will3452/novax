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
        'type', 
        'number',
        'course',
        'signature', 
        'cluster', 
        'relevant_deg',
        'research_spec',
        'schedule_type', 
    ];

    const TYPE_ADMINISTRATOR = 'Administrator'; 
    const TYPE_DEAN = 'Dean'; 
    const TYPE_STUDENT = 'Student';
    const TYPE_FACULTY = 'Faculty'; 


    public function isCoordinator() {
        return nova_get_setting('coordinator_id') == $this->id; 
    }

    public function isStudent() {
        return $this->type == 'Student'; 
    }

    public function isAdmin() {
        return $this->type == 'Administrator'; 
    }

    public function isFaculty() {
        return $this->type == 'Faculty'; 
    }


    public function sections () {
        return $this->belongsToMany(Section::class, 'section_students', 'student_id', 'section_id'); 
    }

    public function groups () {
        return $this->belongsToMany(Group::class, 'group_members', 'student_id', 'group_id'); 
    }

    public function classInvitations () {
        return $this->hasMany(SectionStudent::class, 'student_id'); 
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
