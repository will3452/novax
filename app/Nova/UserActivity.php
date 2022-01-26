<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserActivity extends Resource
{
    use CannotModifyByStudentTrait;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->hasRole(\App\Models\User::TYPE_STUDENT)) {
            return $query->whereUserId(auth()->id());
        }
        return $query;
    }

    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\UserActivity::class;

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
        $file = "/" . str_replace('public', 'storage', $this->file);
        return [
            DateTime::make('Time & Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make('Submitted By', 'user', User::class)
                ->readonly(),
            BelongsTo::make('Activity', 'activity', Activity::class),
            Text::make('Submitted File', fn () =>
                "<a href='$file' target='_blank' class='btn pt-1 btn-xs  btn-primary'> view </a>"
            )->asHtml(),
            Text::make('Score')
                ->sortable()
                ->default(fn () => 0),
            Text::make('Remark'),
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
