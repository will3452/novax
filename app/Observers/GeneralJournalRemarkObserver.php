<?php

namespace App\Observers;

use App\Models\Account;
use Illuminate\Support\Str;
use App\Models\GeneralJournalRemark;

class GeneralJournalRemarkObserver
{
    public function deleting(GeneralJournalRemark $generalJournalRemark)
    {
        $transactions = $generalJournalRemark->transactions;

        foreach ($transactions as $transaction) {
            $transaction->delete();
        }
    }
}
