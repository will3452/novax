<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'ticket_id',
        'user_id',
        'department_id',
        'created_by',
        'status',
        'deadline',
    ];

    const STATUS_FOR_APPROVAL = 'FOR APPROVAL';
    const STATUS_ON_GOING = 'ON GOING';
    const STATUS_ON_HOLD = 'ON HOLD';
    const STATUS_CANCELLED = 'CANCELLED';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_DONE = 'DONE';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function taskActivities()
    {
        return $this->hasMany(TaskActivity::class);
    }
}
