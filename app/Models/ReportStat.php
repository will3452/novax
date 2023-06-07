<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_id',
        'condition_id',
        'report_date',
        'note',
    ];
}
