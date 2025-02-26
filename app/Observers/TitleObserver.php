<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Title;
use App\Models\Panellist;
use App\Models\Section;
use Illuminate\Support\Str;
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

        $courseCode = $title->section->group_code;
        $seq = 1;
        $sections = Section::whereSchoolYear(nova_get_setting('school_year'))->get();
        foreach ($sections as $section) {
            $seq += $section->titles->count();
        }
        $year = explode('-', nova_get_setting('school_year'))[0];
        $code = $year . $courseCode . $seq;

        $group = Group::create([
            'title_id' => $title->id,
            'code' => $code,
        ]);

        Panellist::create([
            'status' => 'APPROVED',
            'faculty_id' => $title->faculty_id,
            'group_id' => $group->id,
            'type' => 'Adviser',
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
