<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Record extends Resource
{
    public static $group = '1Patient Management';

    public static function availableForNavigation(Request $request)
    {
        return false;
    }

    public static function label () {
        return "Health Backgrounds";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Record::class;

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
        'condition',
        'doctor',
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
            Date::make('Diagnosis Date')
                ->hideFromIndex()
                ->sortable(),
            Date::make('Last Visit Date')
                ->hideFromIndex()
                ->sortable(),
            BelongsTo::make('Patient', 'patient', PatientRecord::class),
            Text::make('Condition'),
            Textarea::make('Allergies')
                ->showOnIndex()
                ->alwaysShow(),
            Textarea::make('Family history')
                ->alwaysShow(),
            Textarea::make('Previous Hospitalization', 'prev_hospitalization')
                ->alwaysShow(),
            Text::make('Dentist', 'doctor')
                ->hideFromIndex()
                ->default(fn () => auth()->user()->name),
            Textarea::make('Notes')
                ->showOnIndex()
                ->alwaysShow(),
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
            (new DownloadExcel())
                ->withHeadings(),
        ];
    }
}
