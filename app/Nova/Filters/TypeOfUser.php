<?php

namespace App\Nova\Filters;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class TypeOfUser extends Filter
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
        $data = [
            User::TYPE_PARENT => User::TYPE_PARENT,
            User::TYPE_STUDENT => User::TYPE_STUDENT,
            User::TYPE_TEACHER => User::TYPE_TEACHER,
        ];
        $userType = UserType::get()->pluck('description', 'description')->toArray();
        return array_merge($userType, $data);
    }
}
