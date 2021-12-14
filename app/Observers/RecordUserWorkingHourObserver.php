<?php

namespace App\Observers;

use App\Mail\JobHasBeenCompleted;
use App\Models\RecordUserWorkingHour;
use Illuminate\Support\Facades\Mail;

class RecordUserWorkingHourObserver
{
    public function created(RecordUserWorkingHour $recordUserWorkingHour)
    {
        if ($recordUserWorkingHour->record->workingHours()->sum('hour') >= $recordUserWorkingHour->record->standard_time) {
            $userRecords = $recordUserWorkingHour->record->userRecords;
            foreach ($userRecords as $record) {
                Mail::to($record->user->email)->send(new JobHasBeenCompleted($record->record));
            }
        }
    }
}
