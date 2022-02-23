<?php

namespace App\Models\Traits;

use App\Models\StudentParent;

trait HasStudentsOrParent
{
    public function parent()
    {
        return $this->hasOne(StudentParent::class, 'student_id');
    }

    public function students()
    {
        return $this->hasMany(StudentParent::class, 'parent_id');
    }
}
