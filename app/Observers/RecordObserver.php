<?php

namespace App\Observers;

use App\Models\Record;

class RecordObserver
{
    public function creating(Record $record)
    {
        if ($record->job_status === Record::JOB_STATUS_WITH_PROBLEM) {
            $record->status = Record::STATUS_PENDING;
        } elseif ($record->date_send) {
            $record->status = Record::STATUS_SENT;
        }
    }
}
