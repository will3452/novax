<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'epic_id',
        'project_id',
    ];

    public function epic()
    {
        return $this->belongsTo(Epic::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
