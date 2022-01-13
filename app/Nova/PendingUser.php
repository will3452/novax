<?php

namespace App\Nova;

use App\Nova\Actions\ApproveNow;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class PendingUser extends User{

    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNull('approved_at')->where('email', '!=', 'super@admin.com');
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function actions(Request $request)
    {
        return [
            ApproveNow::make()
                ->showOnTableRow()
        ];
    }
}
