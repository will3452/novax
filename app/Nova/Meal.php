<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Meal extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Meal::class;

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
            Select::make('Type')
                ->rules(['required'])
                ->options([
                    'breakfast' => 'Breakfast',
                    'lunch' => 'Lunch',
                    'dinner' => 'Dinner',
                    'supper' => 'Supper',
                ]),
            Textarea::make('Nutrition')
                ->alwaysShow()
                ->rules(['required'])
                ->help('please use two dash ( -- ) to separate the following nutrition. eg. 836 calories--53g protein--78g carbs'),
            Textarea::make('Foods and drinks', 'foods')
                ->alwaysShow()
                ->rules(['required'])
                ->help('please use two dash ( -- ) to separate the following foods. eg. 1 glass of water--3 fried chicken'),
            Textarea::make('Allergen Information')
                ->alwaysShow()
                ->help('please use two dash ( -- ) to separate the following information. eg. wheat--peanut--milk'),
            Image::make('Image')
                ->rules(['max:2000', 'image']),
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
