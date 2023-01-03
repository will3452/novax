<?php

namespace App\Nova\Actions;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Currency;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadPayment extends Action
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
            Payment::create([
                'application_id' => $model->id,
                'user_id' => auth()->id(),
                'amount' => $fields['amount'],
                'month' => $fields['month'],
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
            Currency::make('Amount')->rules(['required']),
            Select::make('Month')
                ->options(function () {
                    $arr = [];

                    for ($i= 1; $i <= nova_get_setting('nmp', 6) ; $i++) {
                        $arr[$i] = $i;
                    }

                    return $arr;
                })
        ];
    }
}
