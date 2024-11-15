<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gingivitis',
        'early',
        'moderate',
        'advance',
        'class',
        'overjet',
        'overbite',
        'midline',
        'crossbite',
        'ortho',
        'stay',
        'others',
        'clenching',
        'clicking',
        'tris',
        'muscle',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statuses () {
        return $this->hasMany(DentitionStatus::class, 'record_id');
    }
}
