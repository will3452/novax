<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Store extends User
{
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('age', function (Builder $builder) {
            $builder->whereNotNull('store_name');
        });
    }
}
