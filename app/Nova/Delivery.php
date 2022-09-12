<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Delivery extends Resource
{

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == 'Admin') {
            return $query;
        }
        return $query->whereUserId(auth()->id());
    }

    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, ['Admin', 'Carrier']);
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == 'Admin';
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == 'Admin';
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == 'Admin';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Delivery::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     *
     */

    public function title() {
        return "$this->created_at - Delivery";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Date::make('Created Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('Order', 'order', Order::class),
            BelongsTo::make('Carrier', 'user', User::class),
            Select::make('Status')
                ->options([
                    'Pending' => 'Pending',
                    'Delivered' => 'Delivered',
                ]),
            Textarea::make('Remarks')
                ->alwaysShow(),
            Text::make('Address')->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
