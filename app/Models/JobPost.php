<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'slot',
        'status', 
        'user_id', 
    ]; 

    public function author () {
        return $this->belongsTo(User::class); 
    }

    public function applications () {
        return $this->hasMany(Application::class, 'job_post_id'); 
    }
}
