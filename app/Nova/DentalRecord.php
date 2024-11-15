<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class DentalRecord extends Resource
{
    public static $group = '1Patient Management';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\DentalRecord::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        $userName = $this->user->name;
        return "$userName - Record";
    }

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
            BelongsTo::make('User', 'user', PatientRecord::class),
            HasMany::make('Dentition Statuses', 'statuses', DentitionStatus::class),
            new Panel('Periodontal Screening', [
                Boolean::make('Gingivitis'),
                Boolean::make('Early Periodontitis', 'early'),
                Boolean::make('Moderate Periodontitis', 'moderate'),
                Boolean::make('Advanced Periodontitis', 'advance'),
            ]),
            new Panel('Occulsion', [
                Boolean::make('Class (Molar)', 'class'),
                Boolean::make('Overjet'),
                Boolean::make('Overbite'),
                Boolean::make('Midline Deviation', 'midline'),
                Boolean::make('Crossbite'),
            ]),
            new Panel('Appliances', [
                Boolean::make('Orthodontic', 'ortho'),
                Boolean::make('Stayplate', 'stay'),
                Textarea::make('Others')->default(fn () => "N/a")->alwaysShow(),
            ]),
            new Panel("TMD", [
                Boolean::make('Clenching',),
                Boolean::make('Clicking',),
                Boolean::make('Trismus', 'tris'),
                Boolean::make('Muscle Sp', 'muscle'),
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
