<?php

namespace App\Nova;

use App\Nova\Actions\DownloadTemplate;
use App\Nova\Actions\ImportNewRecords;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProfessionalRecord extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ProfessionalRecord::class;

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
            BelongsTo::make('Alumnus', 'alumnus', Alumnus::class),
            Select::make('Scope', 'scope')
                ->options([
                    'Local' => 'Local',
                    'International' => 'International'
                ]),
            Boolean::make('Is Private'), 
            Boolean::make('Is Aligned'), 
            Select::make('Work Type')
                ->options([
                    'NGO' => 'NGO',
                    'GOVT' => 'GOVT',
                    'Private' => 'Private',
                    'Locally Owned' => 'Locally owned',
                    'International' => 'International', 
                ]),
            Text::make('Company'),
            Text::make('Company Address'), 
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
        return [
            ImportNewRecords::make()->standalone(),
            DownloadTemplate::make()->standalone(), 
        ];
    }
}
