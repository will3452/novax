<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'module_id',
    ];
    public function user()
    {
       return $this->hasMany(User::class, 'user_id');
    }

    public function module()
    {
       return $this->hasMany(Module::class, 'module_id');
    }
}
