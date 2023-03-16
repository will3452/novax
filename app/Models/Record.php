<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_visit',
        'diagnosis',
        'treatment_plan',
        'medications',
        'test_results',
        'progress_notes',
        'follow_up_instructions',
        'discharge_summary',
        'allergies',
        'family_history',
        'social_history',
        'user_id',
    ];

    protected $casts = [
        'date_of_visit' => 'date',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
