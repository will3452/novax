<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Driver extends User {
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'image',
        'type',
        'plate_number',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('user-is-driver', function (Builder $builder) {
            $builder->where('type', User::TYPE_DRIVER);
        });
    }
}