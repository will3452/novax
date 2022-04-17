<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'store_id', // store id
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function ownerStore()
    {
        return $this->belongsTo(User::class, 'store_id');
    }
}
