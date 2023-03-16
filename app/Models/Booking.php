<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'notes',
        'status',
        'proof_of_payment',
        'reference',
        'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'date_time' => 'datetime',
    ];

    protected static function boot() {


        parent::boot();

        static::creating(function($model) {
            $model->reference = Str::random(16);
            $model->status = 'On-Queue';
        });
    }
}
