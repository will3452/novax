<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "role",
        "is_root",
        "reward_points",
    ];

    const ROLE_RESIDENT = "Resident";
    const ROLE_ADMINISTRATOR = "Administrator";
    const ROLE_STAFF = "Staff";

    const ACCESS_MENU_MAP = [
        User::ROLE_RESIDENT => [
            // BarangayDocument::class,
        ],
        User::ROLE_STAFF => [
            BarangayDocument::class,
            BarangayDocument::class,
            Profile::class,
            Barangay::class,
        ],
        User::ROLE_ADMINISTRATOR => [
            BarangayAccess::class,
            BarangayDocument::class,
            Profile::class,
            Barangay::class,
            Document::class,
            User::class,
        ],
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, "user_id");
    }

    public function events()
    {
        return $this->belongsToMany(
            BarangayEvent::class,
            "user_events",
            "user_id",
            "event_id",
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];
}
