<?php

namespace App\Nova;

use App\Models\Module;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use SLASH2NL\NovaBackButton\NovaBackButton;

class Exercise extends Resource
{
    use ShouldBackToParent;

    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Exercise::class;

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

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Hidden::make('type')->default(fn () => Module::TYPE_EXERCISE),
            BelongsTo::make('Week', 'week', Week::class)
                ->hideWhenUpdating(),
            Select::make('Muscle Group')
                ->options(\App\Models\MuscleGroup::get()->pluck('description', 'description'))
                ->rules(['required']),
            Select::make('Day')
                    ->hideWhenUpdating()
                    ->options(fn () =>  optional(\App\Models\Week::find(request()->viaResourceId ?? $this->week_id))->getAvailableDays())
                    ->displayUsing(fn ($item) =>
                    collect(Module::DAY_OPTIONS)
                        ->flatten()
                        ->toArray()[$item]
                        )
                    ->rules(['required']),
                HasMany::make('Instructions', 'instructions', Instruction::class),
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
