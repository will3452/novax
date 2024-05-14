<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\User as ModelsUser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;

class Payment extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return false; 
    }

    public static function group () {
        return auth()->user()->type == ModelsUser::TYPE_STAFF ? 'CASHIER' : 'PAYMENTS'; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Payment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function authorizedToCreate(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]); 
    }
    public function authorizedToDelete(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]); 
    }

    public function authorizedToUpdate(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]); 
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('OR #'), 'id')->sortable(),
            Date::make('Date', 'created_at')->sortable(), 
            BelongsTo::make('Billing Transaction', 'billing', Billing::class),
            Currency::make('Amount')->rules(['required', 'min:1']), 
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
