<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'image',
        'gender',
    ];

    const TYPE_CONDUCTOR = 'CONDUCTOR';
    const TYPE_DRIVER = 'DRIVER';
    const TYPE_CUSTOMER = 'CUSTOMER';
    const TYPE_ADMIN = 'ADMIN';

    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
