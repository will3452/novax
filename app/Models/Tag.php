<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_offer_id',
        'description',
    ];

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
