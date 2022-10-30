<?php

namespace App\Nova;

use App\Models\Shared as ModelShared;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Shared extends Item
{
    public static function label() {
        return 'Shared';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {

        $shared = ModelShared::whereUserId(auth()->id())->whereNotNull('confirmed_at')->get()->pluck('item_id')->all();

        return $query->whereIn('id', $shared);
    }

    public function actions(Request $request)
    {
        return [

        ];
    }

}
