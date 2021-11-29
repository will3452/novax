<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    const JOB_STATUS_NO_PROBLEM = 'NO PROBLEM';
    const JOB_STATUS_WITH_PROBLEM = 'WITH PROBLEM';
    const STATUS_SENT = 'SENT';
    const STATUS_PENDING = 'PENDING';
    const STATUS_ON_GOING = 'ON-GOING';

    
    protected $fillable = [
        'fasp_control_number',
        'fas_control_number',
        'job_type',
        'job_status',
        'fas_pic',
        'maker',
        'received_date',
        'fas_due_date',
        'fasp_due_date',
        'date_send',
        'status',
        'working_hours',
        'standard_time',
    ];

    protected $casts = [
        'received_date' => 'datetime',
        'fas_due_date' => 'datetime',
        'fasp_due_date' => 'datetime',
        'date_send' => 'datetime'
    ];
}
