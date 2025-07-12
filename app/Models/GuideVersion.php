<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide_id',
        'version',
        'content',
        'status',
        'published_at',
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }
}
