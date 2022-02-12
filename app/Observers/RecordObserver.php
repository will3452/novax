<?php

namespace App\Observers;

use App\Models\Record;

class RecordObserver
{
    public function created(Record $record)
    {
        // reference number generation pattern
        //YYYY-MM-DD-ID
        $record->update([
            'reference_number' => "REC-" . now()->format('Ymd') . $record->id,
        ]);
    }
}
