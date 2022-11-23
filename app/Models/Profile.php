<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'smoker',
        'sex',
        'alcohol_drinker',
        'hypertension',
        'diabetes',
        'pwd',
        'phic_membership',
        'birthdate',
        'purok',
        'religion',
        'civil_status',
        'education_attainment',
        'occupation',
        'cpno',
    ];

    public function familyHouseholdProfiles () {
        return $this->belongsToMany(FamilyHouseholdProfile::class, 'profile_family_household_profile', 'profile_id');
    }

}
