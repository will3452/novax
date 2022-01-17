<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bms extends Model
{
    use HasFactory;
    const TYPE_BMI = 'bmi';
    const TYPE_BMR = 'bmr';

    protected $fillable = [
        'user_id',
        'type',
        'weight',
        'height',
        'age',
        'result'
    ];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id');
    }
}
