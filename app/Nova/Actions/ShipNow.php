<?php

namespace App\Nova\Actions;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShipNow extends Action
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
            Delivery::create([
                'user_id' => $fields['user_id'],
                'order_id' => $model->id,
            ]);
            $model->update(['status' => Order::STATUS_FOR_DELIVERY]);
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
            Select::make('Rider', 'user_id')
                ->options(User::whereType(User::TYPE_RIDER)->get()->pluck('name', 'id')),
        ];
    }
}
