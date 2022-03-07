<?php

namespace App\Nova;

use App\Helpers\Model;
use App\Models\Module as ModelsModule;
use App\Nova\Traits\HideTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Module extends Resource
{
    use HideTrait;

    const hideToUserType = Model::forPartners;

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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'code',
        'name'
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
            BelongsTo::make('Subject', 'subject', Subject::class),
            BelongsTo::make('Uploader', 'uploader', User::class)
                ->exceptOnForms(),
            Text::make('Code')
                ->exceptOnForms(),
            Text::make('Description', 'name')
                ->rules(['required']),
            // Select::make('Type')
            //     ->options([
            //         ModelsModule::TYPE_ASYNCHRONOUS => ModelsModule::TYPE_ASYNCHRONOUS,
            //         ModelsModule::TYPE_SYNCHRONOUS => ModelsModule::TYPE_SYNCHRONOUS,
            //     ]),
            HasMany::make('Materials', 'materials', Material::class),
            HasMany::make('Activities', 'activities', Activity::class),
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
