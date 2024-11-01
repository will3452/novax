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
        'progress_status',
    ];

    protected $casts = [
        'date_joined' => 'date',
        'birthday' => 'date',
    ];

    public function attendances () {
        return $this->hasMany(Attendance::class, 'member_id');
    }

    public function getNameAttribute() {
        return "$this->first_name $this->last_name";
    }

    public function tithes () {
        return $this->hasMany(Tithes::class, 'member_id');
    }

    public function isTimer($date, $no) {
        return $this->attendanceAsOf($date) == $no;
    }

    public function attendanceAsOf($date) {
        return $this->attendances()->whereDate('date', '<=', $date)->count();
    }
}
