<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileFamilyHouseholdProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_household_profile_id',
        'profile_id',
    ];
}
