<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'user_id',
        'total',
    ];

    protected $casts = [
        'from' => 'date',
        'to' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
