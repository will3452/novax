<?php

namespace App\Observers;

use App\Models\JobOffer;

class JobOfferObserver
{
    public function creating(JobOffer $jobOffer)
    {
        $jobOffer->employer_id = auth()->id();
        $jobOffer->status = JobOffer::STATUS_OPEN;
    }
}
