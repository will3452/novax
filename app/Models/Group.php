<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function members () {
        return $this->belongsToMany(User::class, 'members', 'group_id', 'user_id');
    }

    public function groupMembers () {
        return $this->hasMany(User::class, 'group_id');
    }
}
