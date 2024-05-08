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

    const FOR_PANEL_APPROVAL = 'For Panel Approval';
    const FOR_COORDINATOR_APPROVAL = 'For Coordinator Approval';
    const FOR_DEAN_APPROVAL = 'For Dean Approval';
    const FOR_DEFENSE = 'For Defense';
    const FINISHED = 'Finished'; 

    protected $casts = [
        'defense_schedule' => 'date', 
    ]; 

    public function title () {
        return $this->belongsTo(Title::class); 
    }
}
