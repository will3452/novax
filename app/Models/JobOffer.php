<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobOffer extends Model
{
    use HasFactory;

    const STATUS_OPEN = 'open';
    const STATUS_CLOSED = 'closed';

    protected $casts = [
        'ended_at' => 'date'
    ];

    protected $fillable = [
        'employer_id',
        'position',
        'description',
        'salary',
        'slot',
        'ended_at',
        'status',
        'urgent'
    ];

    public function getAvailableNumberOfSlotsAttribute()
    {
        return $this->slot - $this->applications()
            ->whereStatus(JobApplication::STATUS_ACCEPTED)
            ->count();
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function isApplicantApplied($applicantId)
    {
        return $this->applications()->where('applicant_id', $applicantId)->count() > 0;
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    protected $with = ['tags'];
}
