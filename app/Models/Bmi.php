<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kg',
        'm',
        'remarks',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
