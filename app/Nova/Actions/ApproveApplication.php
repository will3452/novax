<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use App\Models\TitleApplication;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveApplication extends Action
{
    use InteractsWithQueue, Queueable;

    public $showOnTableRow = true;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach($models as $model) {
            $others = TitleApplication::whereStudentId($model->student_id)->whereSectionId($model->section_id)->whereStatus('PENDING')->where('id', '!=', $model->id)->update(['status' => 'REJECTED']);
            
            $model->update(['status' => 'APPROVED']); 
        }
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
