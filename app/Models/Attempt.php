<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'attemptable_id',
        'attemptable_type',
        'user_id',
        'status',
        'score',
        'number_of_items',
    ];

    const STATUS_IN_PROGRESS = 'In-Progress';
    const STATUS_DONE = 'Done';
    const STATUS_NOT_YET= 'Not Yet';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attemptable()
    {
        return $this->morphTo();
    }

    //helper
    public function isInProgress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }
}
