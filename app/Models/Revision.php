<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'faculty_id',
        'revision', 
    ];

    public function group () {
        return $this->belongsTo(Group::class, 'group_id'); 
    }

    public function faculty () {
        return $this->belongsTo(User::class, 'faculty_id'); 
    }
}
