<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Coordinator extends User{
    protected $table = 'users'; 

    protected static function booted () {
        static::addGlobalScope('coordinator', function (Builder $builder) {
            $builder->where('type', User::TYPE_COORDINATOR); 
        }); 
    }
}