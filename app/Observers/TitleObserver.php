<?php

namespace App\Observers;

use App\Models\Title;

class TitleObserver
{
    /**
     * Handle the Title "created" event.
     *
     * @param  \App\Models\Title  $title
     * @return void
     */
    public function created(Title $title)
    {
        $title->task()->create([
            'user_id' => nova_get_setting('coordinator_id', 1), 
            'description' => "[Coordinator] New Title \"$title->title\" has been created.", 
            'approved_status' => "FOR_DEAN_APPROVAL", 
        ]);
    }

    /**
     * Handle the Title "updated" event.
     *
     * @param  \App\Models\Title  $title
     * @return void
     */
    public function updated(Title $title)
    {
        //
    }

    /**
     * Handle the Title "deleted" event.
     *
     * @param  \App\Models\Title  $title
     * @return void
     */
    public function deleted(Title $title)
    {
        //
    }

    /**
     * Handle the Title "restored" event.
     *
     * @param  \App\Models\Title  $title
     * @return void
     */
    public function restored(Title $title)
    {
        //
    }

    /**
     * Handle the Title "force deleted" event.
     *
     * @param  \App\Models\Title  $title
     * @return void
     */
    public function forceDeleted(Title $title)
    {
        //
    }
}
