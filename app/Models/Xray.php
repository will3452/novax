<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xray extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'type',
        'radiologist_report',
        'findings',
        'diagnosis',
        'follow_up',
        'image',
    ];

    protected $casts = ['date' => 'date'];

    public function patient () {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
