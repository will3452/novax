<?php

namespace App\Nova;

use App\Models\DentitionStatus as ModelsDentitionStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class DentitionStatus extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\DentitionStatus::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'tooth_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tooth_number',
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
            BelongsTo::make('Record', 'record', DentalRecord::class),
            Select::make('Tooth Number', 'tooth_number')
                ->options(ModelsDentitionStatus::toothNumber()),
            Select::make('Condition/Restoration/Surgery', 'status')
                ->options([
                    'D' => 'D',
                    'M' => 'M',
                    'F' => 'F',
                    'I' => 'I',
                    'RF' => 'RF',
                    'MO' => 'MO',
                    'Im' => 'Im',
                    'J' => 'J',
                    'A' => 'A',
                    'AB' => 'AB',
                    'P' => 'P',
                    'In' => 'In',
                    'Fx' => 'Fx',
                    'S' => 'S',
                    'Rm' => 'Rm',
                    'X' => 'X',
                    'XO' => 'XO',
                    'Cm' => 'Cm',
                    'Sp' => 'Sp',
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
