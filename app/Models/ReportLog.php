<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'prepared_by',
        'approved_by',
        'date',
        'type',
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
