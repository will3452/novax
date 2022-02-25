<?php

namespace App\Nova;

use App\Models\Role;
use App\Nova\Actions\Decrypt;
use App\Nova\Actions\Encrypt;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Transaction extends Resource
{

    public static function label()
    {
        return "Encryption & Decryption";
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->hasRole(\App\Models\User::ROLE_PATIENT)) {
            return $query->whereUserId(auth()->id());
        }
        return $query;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->hasRole(Role::SUPERADMIN);
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->hasRole(Role::SUPERADMIN);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Transaction::class;

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
            Date::make('Date', 'created_at')
                ->exceptOnForms(),
            Text::make('Type'),
            BelongsTo::make('Owner', 'user', User::class),
            File::make('Content'),
            Text::make('Key'),
            Text::make('Execution Time (milliseconds)', 'execution_time'),
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
            (new Encrypt())
                ->standalone(),
            (new Decrypt())
                ->standalone(),
        ];
    }
}
