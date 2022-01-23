<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Student extends User {
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('student', function (Builder $builder) {
            $builder->where('type', 'LIKE', "%student%");
        });
    }
}
