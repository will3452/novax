<?php

namespace App\Observers;

use App\Models\JobApplication;
use App\Notifications\ApplicationSent;
use App\Notifications\ApplicationUpdates;

class JobApplicationObserver
{
    public function created(JobApplication $jobApplication)
    {
        auth()->user()->notify(new ApplicationSent($jobApplication));
    }

    public function updated(JobApplication $jobApplication)
    {
        $jobApplication->applicant->notify(new ApplicationUpdates($jobApplication));
    }
}
