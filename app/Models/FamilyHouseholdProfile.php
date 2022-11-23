<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHouseholdProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'four_ps',
        'purok',
        'nhts',
        'dialect',
        'type_of_dwelling',
        'type_of_electricity',
        'source_of_water',
        'sanitation_facilities',
    ];

    public function profiles () {
        return $this->belongsToMany(Profile::class, 'profile_family_household_profile', 'family_household_profile_id');
    }
}
