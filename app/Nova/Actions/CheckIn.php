<?php

namespace App\Nova\Actions;

use App\Models\Slot;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;

class CheckIn extends DetachedAction
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
        $existing = Slot::whereUserId(auth()->id())->whereIsAvailable(true)->exists(); 

        if (! $existing) {
            Slot::create([
                'is_available' => true,
                'user_id' => auth()->id(),
            ]);
        } else {
            return DetachedAction::danger('You already Check in!'); 
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
