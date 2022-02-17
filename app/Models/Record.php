<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'notes',
        'total_amount',
        'amount_paid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
