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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const TYPE_STUDENT = 'student';
    const TYPE_PARENT = 'parent';
    const TYPE_TEACHER = 'teacher';

    public static function OPTION_TYPE()
    {
        $arr = [
            self::TYPE_PARENT => self::TYPE_PARENT,
            self::TYPE_STUDENT => self::TYPE_STUDENT,
            self::TYPE_TEACHER => self::TYPE_TEACHER,
        ];
        $dynamicOptions = UserType::get()->pluck('description', 'description')->toArray();
       return array_merge($dynamicOptions, $arr);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function uploadedModules()
    {
        return $this->hasMany(Module::class, 'uploader_id');
    }

    public function classrooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_room_student', 'student_id', 'class_room_id');
    }


    public function teacherClassrooms()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function userQuizzes()
    {
        return $this->hasMany(UserQuiz::class);
    }

    public function userExams()
    {
        return $this->hasMany(UserExam::class);
    }

    public function userModules()
    {
        return $this->hasMany(UserModule::class);
    }

    public function isModuleDone($moduleId)
    {
        $result = $this->userModules()->where('module_id', $moduleId)->get();
        return count($result) != 0;
    }

    public function getMySubjectProgress($subjectId)
    {
        $subject = Subject::find($subjectId);
        $markAsDoneCount = $this->userModules()->where('subject_id', $subjectId)->count();

        return ($markAsDoneCount / $subject->modules()->count()) * 100;
    }

    public function latestRoom()
    {
        return $this->classrooms()->latest()->first();
    }

    public function userStudents()
    {
        return $this->hasMany(UserStudent::class, 'parent_id');
    }

    public function userParent()
    {
        return $this->hasOne(UserStudent::class, 'student_id');
    }

    public function getTotalScoreToSubject($subjectId)
    {
        $total = 0;

        $moduleIds = Subject::find($subjectId)->modules->pluck('id')->toArray();

        $examScore = UserExam::where('user_id', $this->id)->whereIn('module_id', $moduleIds)->sum('score');

        $quizScore = UserQuiz::where('user_id', $this->id)->whereIn('module_id', $moduleIds)->sum('score');

        $total = ($examScore + $quizScore);

        return $total;
    }
}
