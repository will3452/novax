<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    const types = [
        'REQUEST',
        'ISSUE',
    ];
    const prioLevels = [
        'HIGH' => 'HIGH',
        'MEDIUM' => 'MEDIUM',
        'LOW' => 'LOW',
    ];

    const statuses = [
        'Dev' => 'Dev',
        'For Testing' => 'For Testing',
        'For Deployment' => 'For Deployment',
        'Done' => 'Done',
    ];

    const apps = [
        'CMS' => 'CMS',
        'HRIS' => 'HRIS',
        'LMS' => 'LMS',
        'E-LIB' => 'E-LIB',
        'DMS' => 'DMS',
        'AMS' => 'AMS',
        'CHAT BOT' => 'CHAT BOT',
        'FRS' => 'FRS',
        'ALUMNI' => 'ALUMNI',
        'BULLETIN' => 'BULLETIN',
        'CAMPUS TOUR' => 'CAMPUS TOUR',
        'UNIVERSITY MOBILE' => 'UNIVERSITY MOBILE',
        'SCC' => 'SCC',
    ];

    protected $fillable = [
        'application',
        'task',
        'type',
        'status',
        'priority_level',
        'remarks',
        'assignee',
        'client',
    ];
}
