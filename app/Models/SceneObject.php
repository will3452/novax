<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SceneObject extends Model
{
    use HasFactory;
    protected $fillable = [
        'dialog',
        'sound',
        'image',
        'scene_id',
    ];

    public function scene () {
        return $this->belongsTo(Scene::class, 'scene_id');
    }
}
