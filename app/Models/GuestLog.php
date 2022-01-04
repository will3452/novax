<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile_number',
        'arrival',
        'departure',
        'is_short',
        'total_cost',
        'discount',
        'approver_id',
        'user_id',
        'room',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
