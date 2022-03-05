<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'year_level',
        'name',
    ];

    protected $with = [
        'modules'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function getProgress($userId)
    {
        $requireProgress = 0;
        $userProgress = 0;
        $arrIds = [];
        foreach ($this->modules as $m) {

            $arr = $m->activities()->get()->pluck('id')->toArray();
            $requireProgress += count($arr);
            $userProgress += Record::whereUserId($userId)
                ->whereModelType(Activity::class)
                ->whereIn('model_id', $arr)->count();

            $arr = $m->materials()->get()->pluck('id')->toArray();
            $requireProgress += count($arr);
            $userProgress += Record::whereUserId($userId)
                ->whereModelType(Material::class)
                ->whereIn('model_id', $arr)->count();
        }


        return ($userProgress / $requireProgress) * 100;
    }
}
