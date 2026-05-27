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
    public static $group = "";
    public static $displayInNavigation = true;
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "search" query for the given resource.
     * This is the dedicated method for Nova 3 search logic.
     */
    /**
     * Build a "search" query for the given resource.
     * Updated to match the exact signature required by your Nova version.
     */
    public static function buildIndexQuery(
        NovaRequest $request, 
        $query, 
        $search = null, 
        array $filters = [], 
        array $orderings = [], 
        $withTrashed = \Laravel\Nova\TrashedStatus::DEFAULT
    ) {
        // If there's no search term, let the parent handle the default query
        if (empty($search)) {
            return parent::buildIndexQuery($request, $query, $search, $filters, $orderings, $withTrashed);
        }

        return $query->where(function ($q) use ($search) {
            // Search Order ID
            $q->where('id', 'like', "%{$search}%")
              // Search Employee Name in the related 'users' table
              ->orWhereHas('employee', function ($subQuery) use ($search) {
                  $subQuery->where('name', 'like', "%{$search}%");
              });
        });
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
            ID::make('Order ID', 'id')
                ->sortable(),
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
                ->searchable()
                ->sortable(),

            Text::make('No. of Products', function () {
                return $this->orderItems()->count();
            })->onlyOnIndex(),
            Currency::make('Total Amount', function () {
    return $this->orderItems()->get()->sum(function ($item) {
        return ($item->qty ?? 0) * ($item->price ?? 0);
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
    public function employee()
{
    return $this->belongsTo(User::class, 'employee_id');
}
    public static function availableForNavigation(Request $request)
{
    return true;
}
}
