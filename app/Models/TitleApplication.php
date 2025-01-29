<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title_id',
        'status',
        'section_id',
    ];


    const STATUS_APPROVED = 'APPROVED';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_PENDING = 'PENDING';

    public function student () {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function title () {
        return $this->belongsTo(Title::class, 'title_id');
    }

    public function task() {
        return $this->morphOne(Task::class, 'task');
    }
}
