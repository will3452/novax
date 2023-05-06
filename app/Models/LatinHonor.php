<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class LatinHonor extends User
{
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('student', function (Builder $builder) {
            $builder->where('type', User::TYPE_STUDENT);
        });
    }
}
