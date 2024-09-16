<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'employee_no',
        'email', 
        'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
