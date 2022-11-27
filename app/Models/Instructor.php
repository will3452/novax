<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'employee_id',
        'user_id',
    ];


    public function user () {
        return $this->belongsTo(User::class);
    }
}
