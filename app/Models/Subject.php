<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'has_lab',
        'image',
    ];

    public function curriculumSubjects()
    {
        return $this->hasMany(CurriculumSubject::class, 'subject_id');
    }
}
