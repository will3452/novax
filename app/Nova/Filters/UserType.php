<?php

namespace App\Nova\Filters;

use App\Models\UserType as Model;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class UserType extends Filter
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
        return $query->whereType($value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return array_merge([
            \App\Models\User::TYPE_PARENT => \App\Models\User::TYPE_PARENT,
            \App\Models\User::TYPE_STUDENT => \App\Models\User::TYPE_STUDENT,
            \App\Models\User::TYPE_PARTNER => \App\Models\User::TYPE_PARTNER,
            \App\Models\User::TYPE_TEACHER => \App\Models\User::TYPE_TEACHER,
        ], Model::get()->pluck('name', 'name')->toArray());
    }
}
