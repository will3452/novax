<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'description',
        'image',
        'user_id',
        'status',
        'lat',
        'lng',
    ];

    const STATUS_DONE = 'Done';
    const STATUS_NEW = 'New';

    public function category()
    {
        return $this->belongsTo(ReportCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignees () {
        return $this->belongsToMany(User::class, 'user_reports', 'report_id', 'user_id'); 
    }
}
