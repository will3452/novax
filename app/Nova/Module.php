<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Models\Module as ModelsModule;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Module extends Resource
{
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Module::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
       return "$this->type - $this->day";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'day',
        'type',
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
            BelongsTo::make('Week', 'week', Week::class),
            Select::make('Type')
                ->options([
                    ModelsModule::TYPE_EXERCISE => ModelsModule::TYPE_EXERCISE,
                    ModelsModule::TYPE_MEAL => ModelsModule::TYPE_MEAL,
                ])
                ->rules(['required']),
            Select::make('Day')
                    ->options(ModelsModule::DAY_OPTIONS)
                    ->rules(['required']),
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
        return [
            (new NovaBackButton())
                ->onlyOnDetail(),
        ];
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
