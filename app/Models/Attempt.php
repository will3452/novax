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
        'user_id', // student
        'status',
        'score',
        'number_of_items',
        'video',
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

    public function answers()
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    //helper
    public function isInProgress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function isDone()
    {
        return $this->status === self::STATUS_DONE;
    }

    public function markAs($type, $score = 0, $items = 0)
    {

         $this->update([
            'status' => $type,
            'score' => $score,
            'number_of_items' => $items,
        ]);
        return $type;
    }
}
