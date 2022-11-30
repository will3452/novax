<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Client extends Resource
{
    public static $group = "Management";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Client::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'account_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'account_number',
        'first_name',
        'last_name',
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
            BelongsTo::make('Package', 'package', Package::class),
            Text::make('Account Number')
                ->rules(['required', 'unique:clients,account_number,{{resourceId}}']),
            Text::make('First Name')
                ->rules(['required']),
            Text::make('Last Name')
                ->rules(['required']),
            Text::make('Middle Name')
                ->rules(['required']),
            Date::make('Birthday')
                ->rules(['required']),
            Text::make('Email')
                ->rules(['required', 'email']),
            Number::make('Phone')
                ->rules(['required']),
            Text::make('Address')
                ->rules(['required']),
            Hidden::make('created_by_user_id')
                ->default(fn () => auth()->id()),
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
