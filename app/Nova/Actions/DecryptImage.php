<?php

namespace App\Nova\Actions;

use App\Models\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;

class DecryptImage extends Action
{
    use InteractsWithQueue, Queueable;

    public $model;

    public function __construct($model)
    {
        $this->model = $model;
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
        $key = $fields['key'];
        foreach ($models as $model) {
            if ($model->key !== $key) {
                return Action::danger('Invalid Key!');
            }

            if (! auth()->user()->hasRole(Role::SUPERADMIN)) {
                $model->update(['opened_at' => now()]);
            }
            return Action::openInNewTab("/view-file?model=$model->id&key=$key");
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
            Text::make('key')
                ->default(fn () => optional($this->model)->key)
                ->rules(['required']),
        ];
    }
}
