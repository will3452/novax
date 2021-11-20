<?php

namespace App\Models;

use App\Observers\SubjectObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_number',
        'description',
        'code',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(SubjectObserver::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function getTotalScore()
    {
        $total = 0;
        $modules = $this->modules;

        foreach ($modules as $module) {
            //for quiz
            $qs = $module->quizzes;
            foreach ($qs as $q) {
                $total += count($q->questions);
            }

            //for exam
            $qs = $module->exams;
            foreach ($qs as $q) {
                $total += count($q->questions);
            }
        }

        return $total;
    }
}
