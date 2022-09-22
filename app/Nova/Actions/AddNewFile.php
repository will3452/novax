<?php

namespace App\Nova\Actions;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddNewFile extends Action
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
        $file = $fields->file->store('public');
        $fileArray = explode('/', $file);
        // error_log($file);
        Item::create([
            'file' => $fileArray[1],
            'name' => $fields->name,
            'size' => $fields->file->getSize(),
            'type' => $fields->file->getClientOriginalExtension(),
            'user_id' => $fields->user_id,
        ]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Hidden::make('user_id')->default(fn () => auth()->id()),
            Text::make('Name')
                ->rules(['required']),
            File::make('File')
                ->rules(['required', 'max:' . nova_get_setting('max_upload', 10000)]),
        ];
    }
}
