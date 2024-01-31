<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
{
    use HasFactory;

    protected $table = 'alumnus'; 

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'batch', 
        'birthday', 
        'program',
        'employment_status', 
        'soc_med', 
    ]; 

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    protected $casts = [
        'birthday' => 'date'
    ]; 
}
