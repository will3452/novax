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
        'company_control_number',
        'customer_control_number',
        'job_type',
        'job_status',
        'maker',
        'received_date',
        'customer_due_date',
        'company_due_date',
        'date_send',
        'status',
        'standard_time',
    ];

    protected $casts = [
        'received_date' => 'datetime',
        'customer_due_date' => 'datetime',
        'company_due_date' => 'datetime',
        'date_send' => 'datetime'
    ];

    public function userRecords()
    {
        return $this->hasMany(UserRecord::class, 'record_id');
    }
}
