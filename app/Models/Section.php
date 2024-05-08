<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    
    const IC_TYPE_CAPSTONE = 'Capstone';
    const IC_TYPE_THESIS = 'Thesis'; 
    const PHASE_PROPOSAL = 'Proposal';
    const PHASE_GATHERING = 'Data Gathering';
    const PHASE_FINAL = 'Final'; 

    protected $fillable = [
        'course_id',
        'section',
        'term',
        'school_year',
        'no_of_students',
        'thesis_phase',
        'ic_type',
        'creator_id',
        'pass_code', 
    ]; 

    public function course () {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function creator () {
        return $this->belongsTo(User::class, 'creator_id'); 
    }


}
