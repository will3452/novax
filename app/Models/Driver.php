<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'email',
        'employee_no',
        'driver_lic_b',
        'driver_lic_c',
        'med_cert',
        'user_id',
    ]; 

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
