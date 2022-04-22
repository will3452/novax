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
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'picture',
        'name',
        'email',
        'password',
        'number', //student number
        'level', // year level
        'type', // teacher, admin, student
        'strand',
    ];

    public function isAdmin()
    {
        return $this->type === 'Admin';
    }

    const LEVEL = [
        "Grade 11",
        "Grade 12",
    ];

    const STRAND = [
        "GAS",
        "ABM",
        "STEM",
        "HUMSS",
    ];

    public function totalExams()
    {
        return Exam::whereStrand($this->strand)->whereLevel($this->level)->count();
    }


    public function notFinished()
    {
        $records = Record::whereUserId($this->id)->count();
        return ($this->totalExams() - $records) <= 0 ? 0 :$this->totalExams() - $records;
    }

    public function incomingExam()
    {
        if ($this->notFinished() == 0) {
            return 'No incoming exam';
        }
        $exam = Exam::whereStrand($this->strand)->whereLevel($this->level)->orderBy('opened_at', 'DESC')->first();
        return $exam->opened_at->format('m/d/y');
    }

    const TYPE_STUDENT = "Student";
    const TYPE_TEACHER = "Teacher";
    const TYPE_OTHER = "Other";

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
