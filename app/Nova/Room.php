<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Room extends Resource
{
    public static $polling = true;

    public static $pollingInterval = 5;

    public static $showPollingToggle = true;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Room::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public function subtitle()
    {
        return "$this->category - $this->price";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        "name",
        "category",
        "price",
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
            Select::make('Category')
                ->displayUsingLabels()
                ->options(RoomCategory::get()->pluck('name', 'name'))
                ->rules(['required']),

            Text::make('Name')
                ->rules(['required']),

            Text::make('Room Number', 'number')
                ->rules(['required', 'unique:rooms,number,{{resourceId}}']),

            Image::make('Picture')
                ->disableDownload(),

            Currency::make('Price')
                ->help('Per Night')
                ->rules(['required']),

            Trix::make('Description')
                ->alwaysShow()
                ->rules(['required'])
                ->help('Please provide useful information. e.g No. of beds, With T.V and etc..,'),

            Boolean::make('Available'),


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
