<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpfulCount extends Model
{
    use HasFactory;
    protected $fillable = [
        'guide_id',
        'user_id',
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
