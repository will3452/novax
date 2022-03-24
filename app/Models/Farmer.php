<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'barangay',
        'birth_date',
        // 'title',
        'gender',
        'beneficiary',
        'occupation',
        'is_4ps_family',
        'name_of_spouse',
        'civil_status',
        'other_source_of_income',
        'phone',
        'email',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';

    const STATUS_SINGLE = 'Single';
    const STATUS_MARRIED = 'Married';
    const STATUS_DIVORCED = 'Divorced';
    const STATUS_SEPARATED = 'Separated';
    const STATUS_WIDOWED = 'Widowed';

    public function getAgeAttribute(): int
    {
        return $this->birth_date->age;
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }
}
