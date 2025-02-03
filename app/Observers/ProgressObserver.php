<?php

namespace App\Observers;

use App\Models\Panellist;
use App\Models\Progress;
use Illuminate\Support\Facades\Log;

class ProgressObserver
{
    /**
     * Handle the Progress "created" event.
     *
     * @param  \App\Models\Progress  $progress
     * @return void
     */
    public function created(Progress $progress)
    {
        $p = Panellist::whereGroupId($progress->group_id)->whereType('Adviser')->first();

        $progress->task()->create([
            'user_id' => $p->faculty_id,
            'description' => "New progress report of " . $progress->group->code,
            'approved_status' => Progress::FOR_COORDINATOR,
        ]);
    }

    /**
     * Handle the Progress "updated" event.
     *
     * @param  \App\Models\Progress  $progress
     * @return void
     */
    public function updated(Progress $progress)
    {
    }

    /**
     * Handle the Progress "deleted" event.
     *
     * @param  \App\Models\Progress  $progress
     * @return void
     */
    public function deleted(Progress $progress)
    {
        //
    }

    /**
     * Handle the Progress "restored" event.
     *
     * @param  \App\Models\Progress  $progress
     * @return void
     */
    public function restored(Progress $progress)
    {
        //
    }

    /**
     * Handle the Progress "force deleted" event.
     *
     * @param  \App\Models\Progress  $progress
     * @return void
     */
    public function forceDeleted(Progress $progress)
    {
        //
    }
}
