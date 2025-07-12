<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_user_id',
        'title',
        'slug',
        'cover_image',
        'content',
        'version',
        'status',
        'published_at',
        'organization_id',
        'helpful_count',
        'category',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'guide_tags', 'guide_id', 'tag_id');
    }

    public function guideTags()
    {
        return $this->hasMany(GuideTag::class, 'guide_id');
    }

    public function versions()
    {
        return $this->hasMany(GuideVersion::class, 'guide_id');
    }
}
