<?php

namespace App\Nova;

use App\Nova\Actions\AdoptIt;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Pet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Pet::class;

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
            Text::make('Name')->rules(['required']),
            Select::make('Type')->options([
                'Dog' => 'Dog',
                'Cat' => 'Cat',
            ])->rules(['required']),
            Select::make('Size')->options([
                'Small' => 'Small',
                'Medium' => 'Medium',
                'Large' => 'Large',
                'X-Large' => 'X-Large',
            ])->rules(['required']),
            Image::make('Image')->rules(['required']),
            Select::make('Gender')->options([
                'Female' => 'Female',
                'Male' => 'Male',
            ])->rules(['required']),
            Textarea::make('Story')->rules(['required']),
            Text::make('Status', function () {
                return $this->adopt == null ? 'AVAILABLE' : 'ADOPTED';
            }),
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
            AdoptIt::make(),
        ];
    }
}
