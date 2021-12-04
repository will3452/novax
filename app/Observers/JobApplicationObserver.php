<?php

namespace App\Observers;

use App\Models\JobApplication;
use App\Notifications\ApplicationSent;

class JobApplicationObserver
{
    public function created(JobApplication $jobApplication)
    {
        auth()->user()->notify(new ApplicationSent($jobApplication));
    }
}
