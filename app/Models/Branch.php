<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'address',
        'phone',
    ];

    public function users () {
        return $this->belongsToMany(User::class, 'branch_assignments', 'branch_id', 'user_id');
    }
}
