<?php

namespace App\Observers;

use App\Models\Offering;
use App\Models\Program;

class OfferingObserver
{
    /**
     * Handle the Offering "created" event.
     *
     * @param  \App\Models\Offering  $offering
     * @return void
     */
    public function created(Offering $offering)
    {
        $offering->update(['date' => $offering->program->date]);
    }

    /**
     * Handle the Offering "updated" event.
     *
     * @param  \App\Models\Offering  $offering
     * @return void
     */
    public function updated(Offering $offering)
    {
        //
    }

    /**
     * Handle the Offering "deleted" event.
     *
     * @param  \App\Models\Offering  $offering
     * @return void
     */
    public function deleted(Offering $offering)
    {
        //
    }

    /**
     * Handle the Offering "restored" event.
     *
     * @param  \App\Models\Offering  $offering
     * @return void
     */
    public function restored(Offering $offering)
    {
        //
    }

    /**
     * Handle the Offering "force deleted" event.
     *
     * @param  \App\Models\Offering  $offering
     * @return void
     */
    public function forceDeleted(Offering $offering)
    {
        //
    }
}
