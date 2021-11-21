<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    const STATUS_INTERVIEW = 'interview';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'job_offer_id',
        'applicant_id',
        'status',
        'message',
    ];

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }
}
