<?php

namespace App\Observers;

use App\Models\Penalty;
use App\Models\Revenue;

class PenaltyObserver
{
    /**
     * Handle the Penalty "created" event.
     *
     * @param  \App\Models\Penalty  $penalty
     * @return void
     */
    public function created(Penalty $penalty)
    {
        Revenue::create(['amount' => $penalty->amount]);
    }

    /**
     * Handle the Penalty "updated" event.
     *
     * @param  \App\Models\Penalty  $penalty
     * @return void
     */
    public function updated(Penalty $penalty)
    {
        //
    }

    /**
     * Handle the Penalty "deleted" event.
     *
     * @param  \App\Models\Penalty  $penalty
     * @return void
     */
    public function deleted(Penalty $penalty)
    {
        //
    }

    /**
     * Handle the Penalty "restored" event.
     *
     * @param  \App\Models\Penalty  $penalty
     * @return void
     */
    public function restored(Penalty $penalty)
    {
        //
    }

    /**
     * Handle the Penalty "force deleted" event.
     *
     * @param  \App\Models\Penalty  $penalty
     * @return void
     */
    public function forceDeleted(Penalty $penalty)
    {
        //
    }
}
