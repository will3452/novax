<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'age',
        'password',
        'approved_at',
        'valid_id',
        'is_vaccinated',
        'gender',
        'birthdate',
    ];

    public function getMiAttribute()
    {
        return $this->middle_name[0];
    }

    public function getNameAttribute()
    {
        return "$this->first_name $this->last_name";
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
        'approved_at' => 'datetime',
        'birthdate' => 'date',
    ];

    public function requests(): HasMany
    {
        return $this->hasMany(UserRequest::class, 'user_id');
    }


    public function getTotalPendingRequestAttribute(): int
    {
        return $this->requests()
            ->whereStatus(UserRequest::STATUS_UNRESOLVED)
            ->count();
    }

    public function getNotAdminAttribute(): bool
    {
        return ! $this->hasRole(Role::SUPERADMIN);
    }

    //model action
    public function approvedNow(): bool
    {
       return $this->update(['approved_at' => now()]);
    }

    //local scopes
    public function scopeNotApproved($q)
    {
       return $q->whereNull('approved_at');
    }

    public function scopeApproved($q)
    {
       return $q->whereNotNull('approved_at');
    }


}
