<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'background',
    ];

    public function objects () {
        return $this->hasMany(SceneObject::class, 'scene_id');
    }
}
