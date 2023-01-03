<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        'amount',
        'month',
        'proof',
        'approved_at',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function application () {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
