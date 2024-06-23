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
        if ($progress->status == Progress::FOR_COORDINATOR) {
            $progress->task()->create([
                'user_id' => nova_get_setting('coordinator_id'), 
                'description' => "New progress report of " . $progress->group->code, 
                'approved_status' => Progress::APPROVED, 
            ]); 
        }

        if ($progress->status == Progress::APPROVED) {
            Progress::whereGroupId($progress->group_id)->update([
                'is_ready_for_oral_def' => true, 
            ]); 
        }
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
