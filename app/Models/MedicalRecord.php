<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'initial_pain_score', 
        'initial_remarks', 
        'follow_up_pain_score',
        'follow_up_remarks',
        'physician', 
    ]; 

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
