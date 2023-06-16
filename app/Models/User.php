<?php

namespace App\Models;

use App\GradeHelpers;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'last_login_at',
        'remark',
    ];

    const TYPE_TEACHER = 'Teacher';
    const TYPE_STUDENT = 'Student';
    const TYPE_ADMIN = 'Administrator';

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function teachingLoads()
    {
        return $this->hasMany(TeachingLoad::class, 'teacher_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function subjects()
    {
        return $this->profile->curriculum->curriculumSubjects;
    }

    public function progress()
    {
        $subjects = $this->subjects();
        $withGrades = StudentRecord::where([
            'student_id' => $this->id,
        ])->whereIn('subject_id', $subjects->pluck('id')->all())->get()->pluck('subject_id')->all();
        $withoutGrades = array_values(array_diff($subjects->pluck('id')->all(), $withGrades));
        // $withoutGrades = [];

        $subjectCount = count($subjects);
        $progressRate = 0;
        try {
            $progressRate = (($subjectCount - count($withoutGrades)) / $subjectCount) * 100;
        } catch (Exception $e) {
            $progressRate = 0;
        }

        return [
            'total_subject' => $subjectCount,
            'subjects' => $subjects->pluck('id')->all(),
            'with_grades' => $withGrades,
            'without_grades' => $withoutGrades,
            'progress_rate' => $progressRate,
        ];
    }

    public function lessThan($less, $arr)
    {
        return count(array_filter($arr, function ($number) use ($less) {
            return $number < $less;
        })) != 0;
    }

    public function calculateGPA()
    {
        try {
            $remarks = null;
            $progressRate = $this->progress()['progress_rate'];
            if ($progressRate == 100) {
                $subjects = $this->subjects();
                $totalGrade = 0;
                $grades = [];
                $n = 0;
                foreach ($subjects as $subject) {
                    $grade = StudentRecord::whereStudentId($this->id)->latest()->first()->total_grade;
                    $grades[] = $grade;
                    $totalGrade += $grade;
                    $n++;
                }

                $gradeAverage = $totalGrade / $n;

                if ($gradeAverage >= 94 && !$this->lessThan(94, $grades)) {
                    $remarks = 'SUMMA CUM LAUDE';
                } else if ($gradeAverage >= 88 && !$this->lessThan(88, $grades)) {
                    $remarks = 'MAGNA CUM LAUDE';
                } else if ($gradeAverage >= 85 && !$this->lessThan(85, $grades)) {
                    $remarks = 'CUM LAUDE';
                } else if ($gradeAverage >= 85 && !$this->lessThan(85, $grades)) {
                    $remarks = 'WITH DISTINCTION';
                }
                $this->update(['remark' => $remarks]);
            }
        } catch (Exception $e) {

            return $e->getMessage();
            return null;
        }
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

    public function getGradeFromScores($loadId, $category, $term = "Prelim")
    {
        $activities = Activity::where(['teaching_load_id' => $loadId, 'category' => $category, "term" => $term])->get();
        $maxScore = $activities->sum('max_score');
        $activitiesId = $activities->pluck('id')->toArray();
        $totalScore = Score::where('student_id', $this->id)->whereIn('activity_id', $activitiesId)->sum('score');

        // return "$term = $maxScore &  $totalScore";
        return GradeHelpers::getTransmutedValue($totalScore, $maxScore);
        // return ($totalScore / $maxScore) * 100;
    }

    public function getLectureGrades($loadId, $term = 'Prelim')
    {
        $exam = $this->getGradeFromScores($loadId, 'Exam', $term) * .4;
        $quiz = $this->getGradeFromScores($loadId, 'Quizzes/Seatwork/Assignment', $term) * .25;
        $attendance = $this->getGradeFromScores($loadId, 'Attendance', $term) * .1;
        $longQuiz = $this->getGradeFromScores($loadId, 'Long Quiz', $term) * .15;
        $recitation = $this->getGradeFromScores($loadId, 'Recitation', $term) * .1;

        // return $this->getGradeFromScores($loadId, 'Attendance', $term);

        return ($exam + $quiz + $attendance + $longQuiz + $recitation);
    }

    public function getLaboratoryGrades($loadId, $term = 'Prelim')
    {
        $lab = $this->getGradeFromScores($loadId, 'Lab Activities', $term) * .5;
        $exam = $this->getGradeFromScores($loadId, 'Exam', $term) * .4;
        $attendance = $this->getGradeFromScores($loadId, 'Attendance', $term) * .1;

        return $lab + $exam + $attendance;
    }

    public function getTermGrade($loadId, $term)
    {
        $load = TeachingLoad::find($loadId);
        if ($load->subject->has_lab) {
            $lecture = $this->getLectureGrades($loadId, $term) * .6;
            $lab = $this->getLaboratoryGrades($loadId, $term) * .4;

            return GradeHelpers::getTransmutedValue($lecture + $lab, 100);
        }

        return GradeHelpers::getTransmutedValue($this->getLectureGrades($loadId, $term), 100);
    }

    public function getFinalGrade($loadId)
    {
        // ['Prelim', 'Midterm', 'Pre-Final', 'Final']
        $prelim = $this->getTermGrade($loadId, 'Prelim') * .2;
        $midterm = $this->getTermGrade($loadId, 'Midterm') * .2;
        $preFinal = $this->getTermGrade($loadId, 'Pre-Final') * .3;
        $final = $this->getTermGrade($loadId, 'Final') * .3;
        return ($prelim + $midterm + $preFinal + $final);
        // return GradeHelpers::getTransmutedValue($prelim + $midterm + $preFinal + $final, 100);
    }

    // scopes

    public function scopeStudent($query)
    {
        return $query->whereType(User::TYPE_STUDENT);
    }

    public function studentRecords()
    {
        return $this->hasMany(StudentRecord::class, 'student_id');
    }
}
