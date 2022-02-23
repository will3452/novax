<?php

namespace App\Observers\Traits;

use Illuminate\Support\Str;

trait HasCode
{
    public function generateCode($model, $yearLevel="")
    {
        if ($yearLevel == "") {
            return Str::of($model->year_level . "_" . $model->name)->kebab();
        }
        return Str::of($yearLevel . "_" . $model->name)->kebab();
    }
}
