<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'faculty_id',
        'no_of_students',
        'ic_type',
        'status', 
        'section_id', 
    ]; 
}
