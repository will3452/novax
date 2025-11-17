<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\MarkAsConfirmed;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->role == \App\Models\User::ROLE_EMPLOYEE) {
            $query->where('employee_id', auth()->user()->id);
        }

        return $query;
    }
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

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
            Badge::make('Status')
                ->sortable()
                ->map([
                    \App\Models\Order::STATUS_PENDING => 'warning',
                    \App\Models\Order::STATUS_CONFIRMED => 'success',
                    \App\Models\Order::STATUS_CANCELED => 'danger',
                ]),
            BelongsTo::make('Employee', 'employee', User::class)
                ->showOnIndex(function () {
                    return auth()->user()->role === \App\Models\User::ROLE_ADMIN;
                })
                ->sortable(),
            Text::make('No of Items', function () {
                return $this->orderItems()->count();
            })->onlyOnIndex(),
            Currency::make('Total Amount', function () {
                return $this->orderItems()->get()->sum(function ($item) {
                    return $item->qty * $item->product->price;
                });
            })->onlyOnIndex(),
            HasMany::make('Particulars', 'orderItems', OrderItem::class),
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
        if ($request->has('action')) {
            return [MarkAsConfirmed::make()];
        }
        return [
            MarkAsConfirmed::make()->canSee(function ($request) {
                return $this->status === \App\Models\Order::STATUS_PENDING && $this->orderItems()->count() > 0;
            }),
        ];
    }
}
