<?php

namespace App\Observers;

use App\Models\Story;

class StoryObserver
{
    /**
     * Handle the Story "created" event.
     *
     * @param  \App\Models\Story  $story
     * @return void
     */
    public function created(Story $story)
    {
        $story->update(['project_id' => $story->epic->project_id]);
    }

    /**
     * Handle the Story "updated" event.
     *
     * @param  \App\Models\Story  $story
     * @return void
     */
    public function updated(Story $story)
    {
        //
    }

    /**
     * Handle the Story "deleted" event.
     *
     * @param  \App\Models\Story  $story
     * @return void
     */
    public function deleted(Story $story)
    {
        //
    }

    /**
     * Handle the Story "restored" event.
     *
     * @param  \App\Models\Story  $story
     * @return void
     */
    public function restored(Story $story)
    {
        //
    }

    /**
     * Handle the Story "force deleted" event.
     *
     * @param  \App\Models\Story  $story
     * @return void
     */
    public function forceDeleted(Story $story)
    {
        //
    }
}
