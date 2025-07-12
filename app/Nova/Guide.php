<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Guide extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Guide::class;

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
            ID::make()->sortable(),
            BelongsTo::make('Author', 'author', \App\Nova\User::class)
                ->sortable()
                ->rules('required'),
            BelongsTo::make('Organization', 'organization', \App\Nova\Organization::class)
                ->sortable()
                ->rules('required'),
            Text::make('Title', 'title'),
            Text::make('Slug', 'slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:guides,slug')
                ->updateRules('unique:guides,slug,{{resourceId}}'),
            File::make('Cover Image', 'cover_image'),
            Trix::make('Content', 'content')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Version', 'version')
                ->sortable()
                ->rules('required', 'max:50'),
           Select::make('Status', 'status')
               ->options([
                   'DRAFT' => 'DRAFT',
                   'PUBLISHED' => 'PUBLISHED',
                   'ARCHIVED' => 'ARCHIVED',
               ])
               ->rules('required'),
            Date::make('Published At', 'published_at')
                ->sortable()
                ->rules('nullable', 'date'),
            Select::make('Category', 'category')
                ->options([
                    'DEV' => 'DEV',
                    'QA' => 'QA',
                    'ONBOARDING' => 'ONBOARDING',
                ])
                ->rules('required'),
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
