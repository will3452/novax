<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'email',
        'address',
        'account_number',
        'package_id',
        'phone',
        'created_by_user_id'
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function createdByUser() {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }


}
