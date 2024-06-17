<?php

namespace App\Nova\Actions;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;

class SubmitApplication extends Action
{
    use InteractsWithQueue, Queueable;

    public function shownOnTableRow()
    {
        return true; 
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $file = $fields->file->store('public');
        $arrFile = explode("/", $file);
        $end = end($arrFile); 
        foreach($models as $m) {
            Application::create([
                'job_post_id' => $m->id,
                'trainee_id' => auth()->id(),
                'hte_id' => $m->user_id, 
                'file' => $end, 
            ]); 
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('Resume, Recommendation and etc.., ', 'file')->rules(['required']), 
        ];
    }
}
