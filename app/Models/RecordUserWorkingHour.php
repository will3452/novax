<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordUserWorkingHour extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'record_id',
        'hour',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
