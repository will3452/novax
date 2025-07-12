<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide_id',
        'tag_id',
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
