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
        'suffix',
        'birth_date',
        'address',
        'gender',
        'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';
    const SUFFIX = ['', 'Jr.', 'Sr.', 'II', 'III', 'IV', 'V', 'VI'];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
