<?php

namespace App\Nova;

use App\Nova\Actions\BookService;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Service extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN; 
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN; 
    }
    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN; ; 
    }

    public function authorizedToView(Request $request)
    {
        return false; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Service::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
            Text::make('Name', 'name'),
            Textarea::make('Description', 'description')
                ->showOnIndex(), 
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
         $actions = []; 
         if (auth()->user()->type == \App\Models\User::TYPE_PATIENT) {
            array_push($actions, BookService::make()); 
         }
        return $actions; 
    }
}
