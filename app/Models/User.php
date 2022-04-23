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

    public function getPicture()
    {
        return is_null($this->picture) ? '/no-user.png' : "/storage/$this->picture";
    }

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

    public static function dashboardStudentPerStrand()
    {
        $result = ['Strand' => 'Count'];
        foreach (self::STRAND as $strand) {
            $result[$strand] = self::whereStrand($strand)->count();
        }
        return $result;
    }

    public function dashboardRemainingExams()
    {
        return $this->notFinished();
    }

    public function dashboardAssignedStudents()
    {
        return self::whereType(self::TYPE_STUDENT)->whereStrand($this->strand)->whereLevel($this->level)->get();
    }

    public function yearIsNull($year)
    {
        if (is_null($year)) {
            $year = now()->format('Y');
        }

        return $year;
    }

    public function dashboardMyCreatedExams($year = null)
    {
        $year = $this->yearIsNull($year);
        return Exam::whereTeacherId($this->id)->whereYear('created_at', '=', $year)->get();
    }

    public function dashboardMyCreatedExamsThisYear()
    {
        $exams = $this->dashboardMyCreatedExams()->groupBy(fn($e)=>$e->created_at->format('Y-m-d'));
        $results = [];
        foreach ($exams as $key => $val) {
            $results[$key] = count($val);
        }
        return $results;
    }

    public function completedMyCreatedExams($userId): bool
    {
        $exams = $this->dashboardMyCreatedExams();
        foreach ($exams as $exam) {
            if (! $exam->hasRecordOf($userId)) {
                return false;
            }
        }

        return true;
    }

    public function dashboardTurnedInStudents()
    {
        $students = $this->dashboardAssignedStudents();
        $result = [];
        foreach($students as $student) {
            if ($this->completedMyCreatedExams($student->id)) {
                $result[] = $student;
            }
        }

        return $result;
    }

    public function notFinished($year = null)
    {
        $year = $this->yearIsNull($year);
        $records = Record::whereHas()->whereYear('created_at', '=', $year)->whereUserId($this->id)->count();
        return ($this->totalExams() - $records) <= 0 ? 0 :($this->totalExams() - $records);
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

    // dashboard

    public function dashboardCurrentYearExam()
    {
        $result = [];
        $yearExam = Exam::whereStrand($this->strand)->whereYear('created_at', '=', now()->format('Y'))->get()->groupBy(function ($e) {
            return $e->created_at->format('Y-m-d');
        } );
        foreach ($yearExam as $key => $value) {
            $result[$key] = count($value);
        }

        return $result;
    }

    public function dashboardMyCreatedExamGraded()
    {
        $exams = $this->dashboardMyCreatedExams();
        $totalGraded = 0;
        $notGraded = 0;
        foreach ($exams as $exam) {
            $notGraded += $exam->records()->where('score', '!=', 'Not yet checked')->count();
            $totalGraded += $exam->records()->count();
        }

        return [$notGraded, $totalGraded];
    }
}
