<?php

namespace App\Models;

use App\Models\MealToday;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\ProgressTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, ProgressTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'gender',
    ];

    public function bmis () {
        return $this->hasMany(Bmi::class, 'user_id');
    }

    public function getStatusBmi() {
        return $this->bmis()->latest()->first()->remarks;
    }

    public function deleteMealToday() {
        $exists = MealToday::whereUserId($this->id)->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->exists();

        if ($exists) {
            MealToday::whereUserId($this->id)->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->first()->delete();
        }
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
