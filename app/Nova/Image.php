<?php

namespace App\Nova;

use App\Models\Role;
use App\Nova\Actions\ChangeKey;
use App\Nova\Actions\DecryptImage;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Image extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false || auth()->user()->hasRole(Role::SUPERADMIN);
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true;
        }

        return false;
    }


    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Image::class;

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

    public function canSeeKey()
    {
        return fn () => true;
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
            Date::make('Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            MorphTo::make('Model', 'model'),
            File::make('Image', 'path')
                ->rules(['required']),
            Badge::make('Status', fn () => ! is_null($this->opened_at) ? 'Seen' : 'Not Seen' )
                ->map([
                    'Seen' => 'success',
                    'Not Seen' => 'info',
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

        $model = (self::$model)::find($request->resourceId ?? 1);
        return [
            (new DecryptImage($model))
                ->showOnTableRow(),
        ];
    }
}
