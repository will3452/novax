<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Alumnus extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Alumnus::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title () {
        return "$this->first_name $this->last_name"; 
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('User', 'user', User::class), 
            Text::make('First Name'),
            Text::make('Last Name'),
            Text::make('Middle Name'),
            Select::make('Gender')->options([
                'Male' => 'Male',
                'Female' => 'Female',
                'LGBTQIA' => 'LGBTQIA'
            ]),
            Text::make('Batch'),
            Date::make('Birthday'),
            Text::make('Program'), 
            Select::make('Employment Status')
                ->options([
                    'Employed' => 'Employed',
                    'Unemployed' => 'Unemployed', 
                ]),
            Text::make('Social Media', 'soc_med'), 
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
