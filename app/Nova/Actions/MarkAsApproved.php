<?php

namespace App\Nova\Actions;

use App\Models\SalesRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Currency;

class MarkAsApproved extends Action
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
            $model->update(['status' => 'Confirmed']);
            $items = [];

            if (isset($model->product_id)) {
                $source = 'ORDER';
                $items[] = [
                    'item' => $model->product->name,
                    'qty' =>  $model->quantity,
                ];

            } else {
                $source = 'PRE-ORDER';
                foreach ($model->items as $item) {
                    $items[] = [
                        'item' => $item->product->name,
                        'qty' => $item->quantity,
                    ];
                }
            }

            SalesRecord::create([
                'user_id' => auth()->id(),
                'total' => $fields['payment'],
                'source' => $source,
                'source_id' => $model->id,
                'items' => $items,
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
            Currency::make('Payment')->rules(['required', 'min:1']),
        ];
    }
}
