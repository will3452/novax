<?php

namespace App\Nova\Actions;

use App\Models\TitleApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SendApplication extends Action
{

    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models[0];

        if ($model->status == 'Taken') return Action::danger('This title was already assigned.');
        $exists = TitleApplication::whereStudentId(auth()->id())->whereSectionId($model->section_id)->whereStatus('APPROVED')->exists();
        $submitted = TitleApplication::whereStudentId(auth()->id())->whereSectionId($model->section_id)->whereTitleId($model->id)->exists();
        $alreadyApplied = TitleApplication::whereStudentId(auth()->id())->whereStatus('PENDING')->exists();
        if ($submitted) return Action::danger("You have already applied to this title.");
        if ($exists || $alreadyApplied) return Action::danger("You have already applied to another title in this section. you may contact your adviser to remove your application.");
        TitleApplication::create([
            'title_id' => $model->id,
            'section_id' => $model->section_id,
            'student_id' => auth()->id(),
        ]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
