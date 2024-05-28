<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panellist extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 
        'faculty_id',
        'group_id', 
        'type', 
    ]; 

    const STATUS_PENDING = 'PENDING';
    const STATUS_APPROVED = 'APPROVED'; 
    const TYPE_ADVISER = 'Adviser';
    const TYPE_CHAIR = 'Chair';
    const TYPE_MEMBER = 'Member'; 
    
    public function markAsApproved() {
        $this->update(['status' => 'APPROVED']); 
    }

    public function group() {
        return $this->belongsTo(Group::class, 'group_id'); 
    }

    public function faculty () {
        return $this->belongsTo(User::class, 'faculty_id'); 
    }

    public function task() {
        return $this->morphOne(Task::class, 'task'); 
    }
}
