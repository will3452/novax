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

    const TYPE_SEEKER = 'applicant';
    const TYPE_EMPLOYER = 'employer';
    const TYPE_ADMIN = 'admin';

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
        'email_verified_at',
        'address',
        'logo',
        'approved_at',
        'school',
        'mobile_number',
        'company_name',
    ];

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

    public function jobOffers()
    {
        return $this->hasMany(User::class, 'employer_id');
    }

    public function resume()
    {
        return $this->hasOne(Resume::class, 'applicant_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'applicant_id');
    }

    public function canApplyJob()
    {
        return !empty($this->resume);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class, 'user_id');
    }

    public function getPublicLogoAttribute()
    {
        return '/' . str_replace('public', 'storage', $this->logo);
    }

    protected $with = ['profile'];
}
