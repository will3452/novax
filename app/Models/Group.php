<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'status',
        'defense_schedule', 
    ]; 

    const ADD_PANELIST = 'Add Panelist';
    const FOR_PANEL_APPROVAL = 'For Panel Approval';
    const FOR_COORDINATOR_APPROVAL = 'For Coordinator Approval';
    const FOR_DEAN_APPROVAL = 'For Dean Approval';
    const ONGOING = 'Ongoing';
    const FOR_DEFENSE = 'For Defense';
    const FINISHED = 'Finished'; 

    protected $casts = [
        'defense_schedule' => 'date', 
    ]; 

    

    public function title () {
        return $this->belongsTo(Title::class); 
    }

    public function groupMembers () {
        return $this->hasMany(GroupMember::class, 'group_id'); 
    }

    public function panellists () {
        return $this->hasMany(Panellist::class, 'group_id'); 
    }

    public function task() {
        return $this->morphOne(Task::class, 'task'); 
    }
}
