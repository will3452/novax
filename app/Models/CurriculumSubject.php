<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',
        'semester_id',
        'subject_id'
    ];

    public function semester() {
        return $this->belongsTo(Semester::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function curriculum() {
        return $this->belongsTo(Curriculum::class);
    }
}
