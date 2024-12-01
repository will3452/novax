<?php

namespace App\Nova\Actions;

use App\Models\Driver;
use App\Models\Vehicle;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class Approve extends Action
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
            $model->update([
                'status' => 'approved',
                'driver_id' => $fields->driver_id,
                'vehicle_id' => $fields->vehicle_id,
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
            Select::make('Driver', 'driver_id')
                ->rules(['required'])
                ->options(
                    fn () => Driver::get()->pluck('email', 'id')
                ),
            Select::make('Vehicle', 'vehicle_id')
                ->rules(['required'])
                ->options(
                    fn () => Vehicle::get()->pluck('model', 'id')
                ),
        ];
    }
}
