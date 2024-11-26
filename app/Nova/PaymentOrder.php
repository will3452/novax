<?php

namespace App\Nova;

use App\Nova\Actions\Acknowledge;
use App\Nova\Actions\ChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class PaymentOrder extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PaymentOrder::class;

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
        'created_at',
    ];

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == 'Patient';
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type != 'Patient';;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;
        return false;
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
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('Payer', 'user', User::class)->showOnCreating(fn () => auth()->user()->type != 'Patient'),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Image::make('Receipt', 'file'),
            Badge::make('Status')
                ->map([
                    'Approved' => 'success',
                    'Pending' => 'info',
                    'Declined' => 'danger',
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
        return [
            ChangeStatus::make()
                ->showOnTableRow()
                ->canSee(fn () => auth()->user()->type != 'Patient')
        ];
    }
}
