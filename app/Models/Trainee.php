<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Trainee extends User{
    protected $table = 'users'; 

    protected static function booted () {
        static::addGlobalScope('trainee', function (Builder $builder) {
            $builder->where('type', User::TYPE_TRAINEE); 
        }); 
    }
}