<?php

namespace App\Nova\Filters;

use App\Models\Activity;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ActivityCategory extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

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
        return $query->whereCategory($value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            Activity::CATEGORY_EXAM => Activity::CATEGORY_EXAM,
            Activity::CATEGORY_PROJECT => Activity::CATEGORY_PROJECT,
            Activity::CATEGORY_QUIZ => Activity::CATEGORY_QUIZ,
        ];
    }
}
