<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gender',
        'country',
        'penname',
        'picture',
    ];

    protected $casts = [
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsApproved()
    {
        $this->approved_at = now();
        return $this->save();
    }
}
