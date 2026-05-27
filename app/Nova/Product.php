<?php

namespace App\Nova;

use App\Nova\Actions\AddToCart;
use App\Nova\Actions\RemoveToCart;
use App\Nova\Actions\RunInventoryForecast;
use App\Nova\Actions\SyncDatabase;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Sparkline;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Services\GoogleSheetService;

class Product extends Resource
{
    public static $group = "";
    public static function authorizedToCreate(Request $request)
    {
        if (auth()->user()->role === \App\Models\User::ROLE_ADMIN) {
            return true;
        }
        return false;
    }
    public function authorizedToUpdate(Request $request)
{
return true;
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

    public function title()
{
    return "$this->name (Category: $this->category, Price: $this->price)";
}

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
    "name",
    "sheet_id",
    "category",
    "card_set_category",
    "remarks",
    "search_keyword"
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
        Text::make("PID", "sheet_id")
            ->sortable(),
        Select::make("Type", "category")
            ->options([
                \App\Models\Product::CATEGORY_SINGLE => "Single",
                \App\Models\Product::CATEGORY_BUNDLE => "Bundle",
            ])
            ->rules("required")
            ->sortable(),

        Text::make("Category", "card_set_category")
            ->rules(["required"])
            ->sortable(),

        Text::make("Photo", function () {
            $img = $this->image;
            return $img ? '<img src="' . $img . '" width="80">' : "";
        })->asHtml(),

        Text::make("Image", "image")
            ->rules(["required"])
            ->onlyOnForms(),

        Text::make("Name", function () {

    $name = $this->name ?? "Unnamed Product";

    // =========================
    // SINGLE CARDS
    // =========================
    if ($this->category === \App\Models\Product::CATEGORY_SINGLE) {

        $rarity = $this->rarity;
        $treatment = $this->card_set_treatment;

        if ($rarity || $treatment) {

            $tooltip = '';

            if ($rarity) {
                $tooltip .= 'Rarity: ' . $rarity;
            }

            if ($treatment) {
                $tooltip .= ($tooltip ? "\n" : '') . 'Card Treatment: ' . $treatment;
            }

            return '<span title="' . e($tooltip) . '" style="cursor: help; white-space: pre-line;">'
                . e($name) .
            '</span>';
        }

        return e($name);
    }

    // =========================
    // BUNDLES
    // =========================
    static $rarities = null;

    if ($rarities === null) {
        $service = app(\App\Services\GoogleSheetService::class);
        $rarities = $service->getAllBundleRarities();
    }

    $sheetCategory = strtolower($this->card_set_category ?? '');
    $bundleRarity = null;

    foreach ($rarities as $sheetName => $sheetRarity) {
        if (str_contains($sheetCategory, strtolower($sheetName))) {
            $bundleRarity = $sheetRarity;
            break;
        }
    }

    if ($bundleRarity) {
    return '<span title="' . e($bundleRarity) . '" style="cursor: help;">'
        . e($name) .
    '</span>';
}

    return e($name);

})
->asHtml()
->sortable(),

        Text::make("Search Keywords", "search_keyword")
            ->hideFromIndex()
            ->rules(["required"])
            ->sortable(),

        Currency::make("Price")
            ->sortable()
            ->rules("required", "min:0"),

        Number::make('Default Stock', 'default_stock')
            ->rules('required','integer','min:0')
            ->sortable(),

        Number::make("Stockout", "stockout")
            ->sortable()
            ->help('Number of items requested exceeding available stock.'),

        Number::make("Current Stock", "current_stock")
            ->rules('required','integer','min:0')
            ->sortable(),
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
        return [\App\Nova\Filters\FilterByCategory::make()];
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
    $actions = [];

    // 1. Handle the active action execution payload
    if ($request->has("action")) {
        return [
            AddToCart::make(),
            RemoveToCart::make(),
            new \App\Nova\Actions\SyncProducts,
            SyncDatabase::make()->standalone(),
            new \App\Nova\Actions\ResetStockout,
        ];
    }

    // 2. Inline Row / Cart Actions logic
    if ($this->resource->exists) {
        $INSIDE_CART = $this->orderItems()
            ->whereHas("order", function ($query) {
                $query->where("employee_id", auth()->id())
                      ->whereIn("status", [\App\Models\Order::STATUS_PENDING]);
                })
            ->exists();

        if ($INSIDE_CART) {
            $actions[] = RemoveToCart::make();
        } elseif ($this->current_stock > 0) {
            $actions[] = AddToCart::make();
        }
    }

    // 3. Populate actions globally so Nova has access to them on the frontend.
    // We add 'onlyOnIndex' context checks or leverage default behaviors so Nova handles the visibility toggle natively.
    $actions[] = SyncDatabase::make()->standalone(); 
    $actions[] = (new \App\Nova\Actions\SyncProducts)->onlyOnIndex();
    $actions[] = (new \App\Nova\Actions\ResetStockout)->onlyOnIndex();

    return $actions;   
}
public static function indexQuery(NovaRequest $request, $query)
{
    return $query;
}
public static function availableForNavigation(Request $request)
{
    return true;
}

}
