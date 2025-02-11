<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'no',
        'user_id',
        'unit',
        'destination',
        'date_of_travel',
        'purpose',
        'option',
        'approved_by_id',
        'noted_by_id',
    ];

    protected $casts = [
        'date_of_travel' => 'date',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function approver () {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function notedBy () {
        return $this->belongsTo(User::class, 'noted_by_id');
    }
}
