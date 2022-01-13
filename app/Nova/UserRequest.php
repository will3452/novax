<?php

namespace App\Nova;

use Pdmfc\NovaCards\Info;
use Illuminate\Http\Request;
use App\Nova\Actions\Resolve;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Comodolab\Nova\Fields\Help\Help;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\UserRequest as ModelsUserRequest;

class UserRequest extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return !auth()->user()->hasRole(\App\Models\Role::SUPERADMIN);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\UserRequest::class;

    public static function label()
    {
        return 'Requests';
    }

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
        'created_at'
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->hasRole(\App\Models\Role::SUPERADMIN)) {
            return $query;
        }
        return $query->whereUserId(auth()->id());
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
            Date::make('Requested Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            BelongsTo::make('Requestor Account', 'user', User::class)
                ->exceptOnForms()
                ->rules(['required']),

            BelongsTo::make('Request Document', 'document', Document::class)
                ->rules(['required']),

            Text::make('Requestor Name', 'name')
                ->exceptOnForms()
                ->sortable(),

            Text::make('Document')
                ->exceptOnForms(),

            Text::make('Paid Amount', 'amount')
                ->exceptOnForms(),

            Textarea::make('Description')
                ->alwaysShow()
                ->rules(['required']),

            Help::make('How to pay?', 'please pay to gcash account with number ' . nova_get_setting('gcash_number', '09121808887'))
                ->type('info'),

            Image::make('Proof Of Payment')
                ->rules(['required', 'max:2000'])
                ->help('Maximum of 2mb image only!'),

            Badge::make('Status')
                ->map([
                    ModelsUserRequest::STATUS_RESOLVED => 'success',
                    ModelsUserRequest::STATUS_UNRESOLVED => 'danger'
                ]),

            HasOne::make('Requested Document', 'requestDocument', RequestDocument::class),
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
            Resolve::make()
                ->canSee(function () {
                    return auth()->user()->hasRole(\App\Models\Role::SUPERADMIN);
                }),
        ];
    }
}
