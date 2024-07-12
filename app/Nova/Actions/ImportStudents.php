<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;

class ImportStudents extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    public $sectionId; 

    public function __construct(int $sectionId)
    {
        $this->sectionId = $sectionId; 
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        Excel::import(new \App\Imports\ImportStudents($this->sectionId), $fields->file);  
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('File', 'file')->rules(['required', 'file', 'max:5000']), 
        ];
    }
}
