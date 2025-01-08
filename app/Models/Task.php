<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'story_id',
        'epic_id',
        'project_id',
        'due_date',
        'status'
    ];

    protected $casts = [
        'due_date' => 'datetime'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function epic()
    {
        return $this->belongsTo(Epic::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
