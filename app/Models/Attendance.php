<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'date',
        'program_id',
    ];

    public function member () {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function program () {
        return $this->belongsTo(Program::class, 'member_id');
    }

    protected $casts = ['date' => 'date'];
}
