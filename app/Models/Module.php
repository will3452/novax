<?php

namespace App\Models;

use App\Observers\ModuleObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::observe(ModuleObserver::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
