<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OralDefenseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'group_id',
        'time',
        'date',
        'status',
        'venue',
    ];


    protected $casts = [
        'date' => 'date', 
    ]; 

    public function section () {
        return $this->belongsTo(Section::class, 'section_id'); 
    }

    public function group () {
        return $this->belongsTo(Group::class, 'group_id'); 
    }

    public function tasks() {
        return $this->morphMany(Task::class, 'task'); 
    }
    
    const SUBMIT_ORAL_DEFENSE = 'Submit Oral Defense Request';
    const PANELIST_APPROVAL = 'Panelist Approval';
    const COORDINATOR_APPROVAL = 'Coordinator Approval';
    const APPROVED = 'Approved';
    const REJECTED = 'Rejected';

}
