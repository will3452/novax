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
        'purok',
        'gender',
        'birthdate',
        'image',
        'phone',
        'valid_id',
        'civil_status',
        'approved_at',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function getFullNameAttribute() {
        return "$this->last_name, $this->first_name $this->middle_name";
    }
}
