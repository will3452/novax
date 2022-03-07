<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'details',
        'attachment',
        'status',
        'note',
    ];

    const STATUS_SOLVED = 'Solved';
    const STATUS_PENDING = 'Pending';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActualFileAttribute()
    {
        $arr = explode('/', $this->attachment);
        return end($arr);
    }

    public function markAsSolved($note)
    {
        $this->update([
            'status' => self::STATUS_SOLVED,
            'note' => $note,
        ]);
    }
}
