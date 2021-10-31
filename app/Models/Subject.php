<?php

namespace App\Models;

use App\Observers\SubjectObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::observe(SubjectObserver::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
