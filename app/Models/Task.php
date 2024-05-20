<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'task_id',
        'task_type', 
        'user_id', 
        'description', 
        'approved_status', 
    ]; 

    public function task() {
        return $this->morphTo(); 
    }

    public function assignee() {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
