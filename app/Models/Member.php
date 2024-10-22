<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'address',
        'email',
        'phone',
        'gender',
        'date_joined',
        'profession',
        'status',
    ];

    public function attendances () {
        return $this->hasMany(Attendance::class, 'member_id');
    }
}
