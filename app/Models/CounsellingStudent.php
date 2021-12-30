<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounsellingStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'counselling_id',
    ];

    public function counselling()
    {
        return $this->belongsTo(Counselling::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
