<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'cover',
        'audio',
    ];

    public function getLinkAttribute() {
        if ($this->scene != null) {
            return '/scene/' . $this->scene->id;
        }

        return '/story-mode/' . $this->id;
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function questions () {
        return $this->hasMany(Question::class);
    }

    public function scene() {
        return $this->hasOne(Scene::class);
    }
}
