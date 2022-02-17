<?php

namespace App\Models;

use App\Models\Traits\UserStatusTrait;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, UserStatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birth_date',
        'address',
        'image',
        'type', //admin, patient, staff
        'status', //active, blocked, pending,
    ];


    const STATUS_ACTIVE = 'Active';
    const STATUS_BLOCKED = 'Blocked';
    const STATUS_PENDING = 'Pending';

    const TYPE_PATIENT = 'Patient';
    const TYPE_DENTIST = 'Dentist';
    const TYPE_STAFF = 'Staff';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];
}
