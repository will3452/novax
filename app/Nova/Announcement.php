<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use KirschbaumDevelopment\NovaComments\Commenter;
use Laravel\Nova\Fields\Date;

class Announcement extends Resource
{
    public static function group()
    {
        if (auth()->user()->isStudent()) return "Social"; 
        return "Manage"; 
    }

    public static function authorizedToCreate(Request $request)
    {
        return ! auth()->user()->isStudent(); 
    }

    public function authorizedToUpdate(Request $request)
    {
        return ! auth()->user()->isStudent(); 
    }

    public function authorizedToDelete(Request $request)
    {
        return ! auth()->user()->isStudent();
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Announcement::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title', 
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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(), 
            Text::make('Subject')->sortable(), 
            Textarea::make('Body')->alwaysShow(), 
            MorphMany::make(
                'Comments',
                'comments',
                \KirschbaumDevelopment\NovaComments\Nova\Comment::class
            )->onlyOnForms(),
            new Commenter()
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
