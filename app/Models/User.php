<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'school',
        'approved_at',
        'lat',
        'lng', 
    ];

    public function applications () {
        return $this->hasMany(Application::class, 'trainee_id'); 
    }

    const TYPE_HTE = 'HTE';
    const TYPE_TRAINEE = 'TRAINEE';
    const TYPE_COORDINATOR = 'COORDINATOR';
    const TYPE_ADMIN = 'ADMINISTRATOR'; 

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
        'approved_at' => 'datetime', 
    ];
}
