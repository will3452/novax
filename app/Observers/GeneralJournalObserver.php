<?php

namespace App\Observers;

use App\Models\Account;
use Illuminate\Support\Str;
use App\Models\GeneralJournal;

class GeneralJournalObserver
{
    public function creating(GeneralJournal $generalJournal)
    {
        $generalJournal->user_id = auth()->id();
        $ref = Account::where('name', $generalJournal->account)->first()->prefix;
        $generalJournal->reference_number = $ref;
    }
}
