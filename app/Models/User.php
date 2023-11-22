<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Fields\HasOne;

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
        'balance',
        'mobile',
        'current_fare', 
        'status', 
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
    ];

    public function transactions () {
        return $this->hasMany(Transaction::class, 'user_id');
    }


    public function createTransaction($bound = Transaction::BOUND_IN, $type = Transaction::TYPE_PAY, $amount = 1, $purpose = '',  $status = Transaction::STATUS_DONE, $fromId = null) {
        return $this->transactions()->create([
            'bound' => $bound,
            'type' => $type,
            'amount' => $amount,
            'purpose' => $purpose,
            'status' => $status,
            'from_id' => $fromId,
        ]);
    }


    public function deduct($amount) {
        if ($amount > $this->balance) return false;
        $newBalance = $this->balance - $amount;

        $this->update(['balance' => $newBalance]);

        return $amount;
    }

    public function add($amount) {
        $newBalance = $this->balance + $amount;

        $this->update(['balance' => $newBalance]);

        return $newBalance;
    }

    public function travelHistories() {
        return $this->hasMany(TravelHistory::class);
    }
}
