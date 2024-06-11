<?php

namespace App\Nova\Actions;

use App\Imports\UsersImport;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportUsers extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        Excel::import(new UsersImport($fields->type), $fields->file); 
        return DetachedAction::message('Done!'); 
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
        Select::make('Type')
                ->onlyOnForms()
                ->hideWhenUpdating()
                ->options([
                    \App\Models\User::TYPE_DEAN =>  \App\Models\User::TYPE_DEAN,
                    \App\Models\User::TYPE_STUDENT =>  \App\Models\User::TYPE_STUDENT,
                    \App\Models\User::TYPE_FACULTY =>  \App\Models\User::TYPE_FACULTY,
                ]), 

        File::make('File', 'file')->rules(['required', 'file', 'max:5000']), 
        ];
    }
}
