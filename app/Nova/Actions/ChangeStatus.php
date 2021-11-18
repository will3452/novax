<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Textarea;

class ChangeStatus extends Action
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
        $models->each(function ($model) use ($fields) {
            $model->update([
                'status' => $fields['status'],
                'remarks' => $fields['remarks'] ?? ''
            ]);
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Status')
                ->options([
                    Booking::STATUS_PENDING => Booking::STATUS_PENDING,
                    Booking::STATUS_CANCELLED => Booking::STATUS_CANCELLED,
                    Booking::STATUS_FINISHED => Booking::STATUS_FINISHED,
                ])->rules(['required']),

            Textarea::make('Remarks')
        ];
    }
}
