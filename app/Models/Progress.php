<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', 
        'group_id', 
        'week',
        'from_date',
        'to_date',
        'is_ready_for_oral_def',
        'endorsed_by',
        'preferred_schedule', 
        'description',
    ];

    public function section () {
        return $this->belongsTo(Section::class, 'section_id'); 
    }

    public function group () {
        return $this->belongsTo(Group::class, 'group_id'); 
    }

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'preferred_schedule' => 'date', 
    ]; 
}
