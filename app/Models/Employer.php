<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Employer extends User
{
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('users', function (Builder $builder) {
            $builder->whereType(User::TYPE_EMPLOYER);
        });
    }
}
