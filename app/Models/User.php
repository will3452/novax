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
        'name',
        'email',
        'password',
        'type',
    ];

    const TYPE_ADMIN = 'ADMINISTRATOR';
    const TYPE_CUSTOMER = 'CUSTOMER';
    const TYPE_VENDOR = 'VENDOR';

    public function isAdmin() {
        return $this->type == self::TYPE_ADMIN;
    }

    public function isCustomer() {
        return $this->type == self::TYPE_CUSTOMER;
    }

    public function isVendor() {
        return $this->type == self::TYPE_VENDOR;
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

    public function products () {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function cartItems () {
        return $this->hasMany(CartItem::class, 'user_id');
    }
}
