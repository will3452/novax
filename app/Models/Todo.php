<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'user_id',
    ];

    const STATUS_DONE = 'Done';
    const STATUS_PENDING = 'Not Yet';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function markAsDone()
    {
        return $this->update([
            'status' => self::STATUS_DONE,
        ]);
    }
}
