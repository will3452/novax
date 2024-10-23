<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tithes extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'amount',
        'date',
    ];

    protected $casts = ['date' => 'date'];

    public function member () {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
