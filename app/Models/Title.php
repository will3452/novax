<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'faculty_id',
        'no_of_students',
        'area_of_research',
        'ic_type',
        'status', 
    ];

    const IC_TYPE_CAPSTONE = 'Capstone';
    const IC_TYPE_THESIS = 'Thesis'; 

    const STATUS_TAKEN = 'Taken';
    const STATUS_AVAILABLE = 'Available';

    public function faculty () {
        return $this->belongsTo(User::class, 'faculty_id'); 
    }
}
