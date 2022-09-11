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
        'address',
    ];

    const TYPE_CARRIER = 'Carrier';
    const TYPE_CUSTOMER = 'Customer';
    const TYPE_ADMIN = 'Admin';

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

    public function cartItems () {
        return $this->hasMany(CartItem::class);
    }

    public function isInTheCart($id) {
        return $this->cartItems()->whereProductId($id)->exists();
    }

    public function subTotal() {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total+= ($item->product->price * $item->quantity);
        }

        return $total;
    }
}
