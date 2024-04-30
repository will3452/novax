<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'hte_id', 
        'trainee_id',
    ]; 

    public function hte () {
        return $this->belongsTo(User::class, 'hte_id'); 
    }

    public function trainee () {
        return $this->belongsTo(User::class, 'trainee_id'); 
    }
}
