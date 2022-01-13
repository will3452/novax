<?php

namespace App\Nova;

use App\Models\Vaccination as MVaccination;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Vaccination extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Vaccination::class;

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
        'name',
        'first_dose_at',
        'second_dose_at',
        'vaccine',
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
            Date::make('Recorded At', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            Text::make('Vaccine')
                ->rules(['required']),

            Text::make('Name')
                ->rules(['required', 'unique:vaccinations,name,{{resourceId}}'])
                ->help('FullName: Sur-Name, First-Name, Middle-Name')
                ->sortable(),

            Select::make('Gender')
                ->options([
                    'MALE' => 'MALE',
                    'FEMALE' => 'FEMALE',
                ])
                ->rules(['required']),

            Date::make('Birth Date')
                    ->hideFromIndex()
                    ->rules(['required', 'before:now']),

            Date::make('First Dose At')
                    ->nullable(),

            Date::make('Second Dose At')
                    ->nullable(),

            Select::make('Status')
                    ->options([
                        MVaccination::STATUS_PENDING => MVaccination::STATUS_PENDING,
                        MVaccination::STATUS_FIRST_DOSE => MVaccination::STATUS_FIRST_DOSE,
                        MVaccination::STATUS_SECOND_DOSE => MVaccination::STATUS_SECOND_DOSE,
                    ])
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
