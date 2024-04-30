<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id', 
        'trainee_id',
        'hte_id',
        'status', 
    ]; 

    const STATUS_PENDING = "PENDING"; 
    const STATUS_REJECTED = "REJECTED"; 
    const STATUS_APPROVED = "APPROVED"; 
    const STATUS_FOR_INTERVIEW = "FOR_INTERVIEW"; 
    const STATUS_ONGOING = "ONGOING"; 
    const STATUS_FOR_COMPLIANCES = "FOR_COMPLIANCES"; 

    public function hte () {
        return $this->belongsTo(Hte::class, 'hte_id'); 
    }

    public function trainee () {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }

    public function jobPost () {
        return $this->belongsTo(JobPost::class, 'job_post_id'); 
    }

}
