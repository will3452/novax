<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'type',
        'email',
        'password',
    ];

    const TYPE_EMPLOYEE = 'Employee';
    const TYPE_ADMIN = 'Admin';
    const TYPE_CLIENT = 'Client';

    public function getClientAttribute()
    {
        try {
            return Client::whereEmail($this->email)->first()->id;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getNameAttribute()
    {
        return "$this->last_name, $this->first_name";
    }

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
    ];
}
