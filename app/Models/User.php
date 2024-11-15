<?php

namespace App\Models;

use Exception;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'birthday',
        'type',
        'phone',
        'address',
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
        'birthday' => 'date',
    ];

    public function records () {
        return $this->hasOne(Record::class, 'patient_id');
    }
    public function treatments () {
        return $this->hasMany(Treatment::class, 'patient_id');
    }
    public function xrays () {
        return $this->hasMany(Xray::class, 'patient_id');
    }
    public function appointments () {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
    public function dentalRecord () {
        return $this->hasOne(DentalRecord::class, 'user_id');
    }

    public function hasFilled ($tn) {
        $ss = $this->getStatus($tn);

        return in_array("F", $ss);
    }

    public function getStatus ($tn) {
        try {
            $statuses = $this->dentalRecord
                ->statuses()
                ->whereToothNumber($tn)
                ->get()
                ->pluck('status')
                ->all();

            return $statuses;
        } catch (Exception $e) {
            return $e;
        }
    }
}
