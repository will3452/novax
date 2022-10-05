<?php

namespace App\Nova;

use App\Nova\Actions\viewSharedFile;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SharedFile extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SharedFile::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        if ($this->user_id == auth()->id()) {
            return true;
        }
        return $this->code == '' && ($this->expired_at > now() || $this->expired_at == null);
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
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'expired_at',
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
            Date::make('Date Expired')
                ->sortable(),
            Text::make('Code')
                ->canSee(fn () => $this->user_id == auth()->id()),
            BelongsTo::make('File', 'item', Item::class)->onlyOnDetail(),
            Text::make('File', fn () => $this->item->name)->onlyOnIndex(),
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
            viewSharedFile::make()->canRun(function () {
                return true;
            }),
        ];
    }
}
