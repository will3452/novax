<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

class StudentParent extends Model
{
    // this class is to connect users to users (student to its parents)
    use HasFactory;

    protected $fillable = [
        'student_id',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}
