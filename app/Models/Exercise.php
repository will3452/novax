<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Exercise extends Module {
    protected $table = 'modules';

    public static function booted()
    {
       static::addGlobalScope('exercise', function (Builder $q) {
           $q->whereType(parent::TYPE_EXERCISE);
       });
    }
}
