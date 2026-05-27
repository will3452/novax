<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class FilterByCategory extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = "select-filter";

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where("card_set_category", $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return \App\Models\Product::select("card_set_category")
            ->distinct()
            ->get()
            ->pluck("card_set_category", "card_set_category");
    }
}
