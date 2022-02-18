<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

class Attempt extends Resource
{
    use CannotViewByStudentTrait, CannotModifyByStudentTrait;

    public static $displayInNavigation = false;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Attempt::class;

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
            DateTime::make('Start', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            DateTime::make('Finished', 'updated_at')
                ->exceptOnForms()
                ->sortable(),
            MorphTo::make('Attemptable')
                ->exceptOnForms(),
            BelongsTo::make('Student', 'user', User::class),

            Number::make('Score')
                ->exceptOnForms()
                ->sortable(),

            Number::make('Number Of Items')
                ->exceptOnForms(),

            Text::make('Screen Record', function () {
                $path = "/storage/" . $this->video;
                return "<a href='$path' target='_blank'class='no-underline dim text-primary font-bold'> watch </a>";
            })->asHtml(),

            Text::make('Remarks', fn () =>
                $this->score === $this->number_of_items ?
                "<span class='text-xs bg-success text-white p-2'>Perfect</span>" :
                "<span class='text-xs bg-danger text-white p-2'>---</span>"
            )->asHtml()
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
