<?php

namespace App\Nova;

use Khalin\Nova\Field\Link as LinkField;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Trix;
use App\Models\User as UserModel;
use Laravel\Nova\Http\Requests\NovaRequest;

class Link extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    public  function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    public  function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Link::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'link';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'link',
        'description'
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
            BelongsTo::make('Document', 'document', Document::class),
            LinkField::make('Link')
                ->withMeta(['href' => "//$this->link"])
                ->rules(['required']),
            Trix::make('Description')->alwaysShow(),
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
