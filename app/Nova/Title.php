<?php

namespace App\Nova;

use App\Models\Title as ModelsTitle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Title extends Resource
{
    public static $group = 'Manage';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Title::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'description', 
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
            Text::make('Title')
                ->sortable(), 
            Textarea::make('Description')
                ->alwaysShow(),
            BelongsTo::make('Faculty', 'faculty', User::class), 
            Number::make('No Of Students')->rules(['required']),
            Text::make('Area of Research'),
            Select::make('IC type', 'ic_type')
                ->options([
                    ModelsTitle::IC_TYPE_CAPSTONE => ModelsTitle::IC_TYPE_CAPSTONE,
                    ModelsTitle::IC_TYPE_THESIS => ModelsTitle::IC_TYPE_THESIS,
                ]),
            Badge::make('Status')
                ->map([
                    'Taken' => 'warning',
                    'Available' => 'success', 
                ]), 
            Select::make('Status')
                ->onlyOnForms()
                ->options([
                    'Taken' => 'Taken',
                    'Available' => 'Available', 
                ]), 
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
