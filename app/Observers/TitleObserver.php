<?php

namespace App\Observers;

use App\Models\Title;
use App\Models\TitleApplication;

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
            'approved_status' => "FOR DEAN APPROVAL",
        ]);

        if ($title->type == 'STUDENT') {
            TitleApplication::create([
                'student_id' => $title->created_by_id,
                'status' => 'APPROVED',
                'section_id' => $title->section_id,
                'title_id' => $title->id,
            ]);
        }
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
