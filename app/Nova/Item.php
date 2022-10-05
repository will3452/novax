<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use App\Nova\Actions\AddNewFile;
use App\Nova\Actions\Share;
use App\Nova\Metrics\FilesUploaded;
use Laravel\Nova\Http\Requests\NovaRequest;

class Item extends Resource
{
    public static function label() {
        return 'Files';
    }
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (! auth()->user()->is_admin) {
            return $query->whereUserId(auth()->id());
        }

        return $query;
    }

    public  function authorizedToDelete(Request $request)
    {
        return $this->user_id == auth()->id() || auth()->user()->is_admin;
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
    public static $model = \App\Models\Item::class;

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
        'name',
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
            Hidden::make('user_id')->default(fn () => auth()->id()),
            Text::make('Name')
                ->rules(['required']),
            File::make('File')
                ->rules(['required', 'max:' . nova_get_setting('max_upload', 10000)]),
            Text::make('Size', fn () => number_format(0.000001 * $this->size, 2) . ' mb')
                ->hideWhenCreating(),
            Text::make('Type')
                ->hideWhenCreating(),

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
            FilesUploaded::make()
                ->canSee(function () {
                    return auth()->user()->is_admin;
                })
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
        return [
            AddNewFile::make()->standalone(),
            Share::make()->canRun(fn () => true),
        ];
    }
}
