<?php

namespace App\Nova;

use App\Nova\Actions\AddToCart;
use App\Nova\Actions\RemoveToCart;
use App\Nova\Actions\RunInventoryForecast;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Sparkline;
use Laravel\Nova\Http\Requests\NovaRequest;

class Dss extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->role === \App\Models\User::ROLE_ADMIN;
    }
    public static function label () {
        return "Decision Support";
    }
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->role === \App\Models\User::ROLE_ADMIN) return true;
        if ($request->has('action')) return true;
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title() {
        return "$this->name (Category: $this->category, Price: $this->price)";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'category',
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
            Sparkline::make('Sales Trend')->data(function () {
                $results =  $this->orderItems()
                    ->whereHas('order', function ($query) {
                        $query->where('status', \App\Models\Order::STATUS_CONFIRMED);
                    })
                    ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->groupBy('date')
                    ->orderBy('date', 'DESC')
                    ->pluck('count')
                    ->toArray();
                return $results;
            }),
            Select::make('Category')
                ->options([
                    \App\Models\Product::CATEGORY_SINGLE => 'Single',
                    \App\Models\Product::CATEGORY_BUNDLE => 'Bundle',
                ])
                ->rules('required')
                ->sortable(),
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
            Currency::make('Price')
                ->sortable()
                ->rules('required', 'min:0'),
            Number::make('Default Stock', 'default_stock')
                ->sortable()
                ->rules('required', 'min:0'),
            Number::make('Current Stock', 'current_stock')
                ->sortable()
                ->rules('required', 'min:0'),
            Text::make('Next Day (P/R)', function () {
                $prediction = $this->predictions()->where('interval', 'day')->latest()->first();
                if (! $prediction) return "<span class='text-warning text-xs block text-center'>Insufficient Data.</span>";
                $sales = $prediction->sales_quantity;
                $rec = $prediction->stock_recommendation;
                $s = $rec > 0 ? '<span class="text-success">+</span>' : '';
                return "<div class='text-center' >
                <span>$sales</span>/<span>  $s $rec</span>
                </div>";
            })->asHtml(),
            Text::make('Next Week (P/R)', function () {
                $prediction = $this->predictions()->where('interval', 'week')->latest()->first();
                if (! $prediction) return "<span class='text-warning text-xs block text-center'>Insufficient Data.</span>";
                $sales = $prediction->sales_quantity;
                $rec = $prediction->stock_recommendation;
                $s = $rec > 0 ? '<span class="text-success">+</span>' : '';
                return "<div class='text-center' >
                <span>$sales</span>/<span>  $s $rec</span>
                </div>";
            })->asHtml(),
            Text::make('Next Month (P/R)', function () {
                $prediction = $this->predictions()->where('interval', 'month')->latest()->first();
                if (! $prediction) return "<span class='text-warning text-xs block text-center'>Insufficient Data.</span>";
                $sales = $prediction->sales_quantity;
                $rec = $prediction->stock_recommendation;
                $s = $rec > 0 ? '<span class="text-success">+</span>' : '';
                return "<div class='text-center' >
                <span>$sales</span>/<span>  $s $rec</span>
                </div>";
            })->asHtml(),
            Text::make('Next Year (P/R)', function () {
                $prediction = $this->predictions()->where('interval', 'year')->latest()->first();
                if (! $prediction) return "<span class='text-warning text-xs block text-center'>Insufficient Data.</span>";
                $sales = $prediction->sales_quantity;
                $rec = $prediction->stock_recommendation;
                $s = $rec > 0 ? '<span class="text-success">+</span>' : '';
                return "<div class='text-center' >
                <span>$sales</span>/<span>  $s $rec</span>
                </div>";
            })->asHtml(),
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
            RunInventoryForecast::make()->standalone(),
        ];
    }
}
