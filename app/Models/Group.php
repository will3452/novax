<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use KirschbaumDevelopment\NovaComments\Commentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, Commentable;

    protected $fillable = [
        'title_id',
        'status',
        'defense_schedule',
        'code',
        'verdict',
    ];

    const ADD_PANELIST = 'Add Panelist';
    const FOR_PANEL_APPROVAL = 'For Panel Approval';
    const FOR_COORDINATOR_APPROVAL = 'For Coordinator Approval';
    const FOR_DEAN_APPROVAL = 'For Dean Approval';
    const ONGOING = 'Ongoing';
    const FOR_DEFENSE = 'For Defense';
    const READY_FOR_DEFENSE = 'Ready for defense';
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

    public function comments () {
        return $this->hasMany(Comment::class, 'group_id');
    }

    public function panellists () {
        return $this->hasMany(Panellist::class, 'group_id');
    }

    public function task() {
        return $this->morphOne(Task::class, 'task');
    }

    public function progresses() {
        return $this->hasMany(Progress::class, 'group_id');
    }

    public function revisions() {
        return $this->hasMany(Revision::class, 'group_id');
    }

    public function oralDefenseRequests() {
        return $this->hasMany(OralDefenseRequest::class, 'group_id');
    }
}
