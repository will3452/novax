<?php

namespace App\Nova\Actions;

use App\Models\SharedFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;

class Share extends Action
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
        foreach ($models as $model) {
            SharedFile::create([
                'item_id' => $model->id,
                'expired_at' => $fields->expired_at,
                'code' => $fields->code,
                'user_id' => auth()->id(),
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
            Text::make('Code')
                ->help('This will be provided to those who want to see your file. Leaving a blank means anyone can access it.'),
            Date::make('Date Expired', 'expired_at')
                ->help('This is to limit the time you see your file, leaving a blank means it can be seen even more.')
        ];
    }
}
