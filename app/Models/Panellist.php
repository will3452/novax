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
    ]; 

    const STATUS_PENDING = 'PENDING';
    const STATUS_APPROVED = 'APPROVED'; 

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
