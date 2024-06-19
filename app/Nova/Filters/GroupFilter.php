<?php

namespace App\Nova\Filters;

use App\Models\Panellist;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class GroupFilter extends Filter
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
        if ($value == 'My Group') {
            $groups = []; 
            $ps = Panellist::whereFacultyId(auth()->id())->get(); 
            foreach($ps as $p) {
                array_push($groups, $p->group_id);
            }
            return $query->whereIn('id', $groups); 
        }
        return $query;
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
            'All' => 'All',
            'My Group' => 'My Group', 
        ];
    }
}
