<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Xray extends Resource
{
    public static $group = '1Patient Management';

    public static function label () {
        return "X-Rays";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Xray::class;

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
        'date',
        'type',
        'findings',
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
            Date::make('Date')->sortable(),
            BelongsTo::make('Patient', 'patient', PatientRecord::class,),
            Hidden::make('Type')->default(fn () => 'dental'),
            // Textarea::make('Radiologist Report')
            //     ->alwaysShow(),
            Textarea::make('Result', 'findings')
                ->showOnIndex()
                ->alwaysShow(),
            // Textarea::make('Diagnosis')
            //     ->showOnIndex()
            //     ->alwaysShow(),
            // Textarea::make('Follow Up')
            //     ->alwaysShow(),
            Image::make('Image'),
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
