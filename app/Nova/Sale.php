<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Sale extends Transaction
{
    public static $model = \App\Models\Sale::class;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function actions (Request $request) {
        return [
            new DownloadExcel()
        ];
    }
}
