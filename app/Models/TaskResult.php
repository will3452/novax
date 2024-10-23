<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'result',
        'image',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task () {
        return $this->belongsTo(Task::class, 'task_id');
    }

    protected $casts = [
        'result' => 'json',
    ];
}
