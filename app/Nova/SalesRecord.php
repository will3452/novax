<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use App\Models\PreOrder as PreOrderModel;
use App\Models\Order as OrderModel;
use App\Nova\Actions\ViewPredictions;
use Exception;

class SalesRecord extends Resource
{
    public static $group = 'Sales';
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;

        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, ['administrator', 'sales',]);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SalesRecord::class;

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
                ->sortable(),
            BelongsTo::make('Sales', 'sales', User::class),
            Text::make('Source', function () {
                $source = strtolower($this->source);
                return "<span style='text-transform:capitalize;'>$source</span>";
            })
                ->asHtml(),
            Text::make('Customer Email', function () {
                try {
                    $types = [
                        'ORDER' => 'Order',
                        'PRE-ORDER' => 'PreOrder',
                    ];

                    $type = $types[$this->source];
                    $source = "-";

                    if ($type == 'Order') {
                        $source = OrderModel::with('customer')->find($this->source_id)->customer->email;
                    } else {
                        $source = PreOrderModel::find($this->source_id)->customer['email'];
                    }

                    return $source;
                } catch (Exception  $e) {
                    return "-";
                }
            }),
            // KeyValue::make('Items', 'items'),
            Text::make('Items', function () {
                $result = "<table class='m-4 border' ><tr><th class='border p-2 bg-primary text-white'>Product</th><th class='border p-2 bg-primary text-white'>Quantity </th></tr>";
                foreach ($this->items as $i) {
                    $item = $i['item'];
                    $qty = $i['qty'];
                    $result .= "<tr><td class='border p-2'>$item</td><td class='border p-2'>$qty</td></tr>";
                }
                return $result .= "</table />";
            })->asHtml()->hideFromIndex(),
            Currency::make('Total', 'total')->sortable(),
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
            ViewPredictions::make()->standalone(),
        ];
    }
}
