<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Hte extends User{
    protected $table = 'users'; 

    protected static function booted () {
        static::addGlobalScope('hte', function (Builder $builder) {
            $builder->where('type', User::TYPE_HTE); 
        }); 
    }
}