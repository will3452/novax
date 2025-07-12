<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function guides()
    {
        return $this->belongsToMany(Guide::class, 'guide_tags', 'tag_id', 'guide_id');
    }

    public function guideTags()
    {
        return $this->hasMany(GuideTag::class, 'tag_id');
    }
}
