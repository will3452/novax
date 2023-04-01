<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'academic_year_id',
    ];

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function subjects () {
        return $this->belongsToMany(Curriculum::class, 'curriculum_subject', 'curriculum_id', 'subject_id');
    }
}
