<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'coordinator_id',
        'trainee_id', 
        'remarks', 
    ]; 

    public function coordinator () {
        return $this->belongsTo(Coordinator::class); 
    }

    public function trainee () {
        return $this->belongsTo(Trainee::class); 
    }
}
