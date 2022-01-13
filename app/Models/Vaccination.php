<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_FIRST_DOSE = '1st dose';
    const STATUS_SECOND_DOSE = '2nd dose';

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'status',
        'first_dose_at',
        'second_dose_at',
        'vaccine',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'first_dose_at' => 'date',
        'second_dost_at' => 'date',
    ];
}
