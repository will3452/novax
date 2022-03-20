<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\HasCartItems;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasCartItems;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'type',
        'password',
        'farmers_cooperative_id',
        'phone',
        'store_name',
        'coordinates',
        'phone_verified_at',
    ];

    const TYPE_SELLER = 'Seller';
    const TYPE_CONSUMER = 'Consumer';

    const COORDINATES_SEPARATOR = ',';

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

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'store_id');
    }
}
