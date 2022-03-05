<?php

namespace App\Helpers;

class Model
{
    public static function getModel($model)
    {
        $modelPath = get_class($model);
        $arr = explode('\\', $modelPath);
        return end($arr);
    }


    public static function getFullModel(string $model)
    {
        return "\App\\Models\\$model";
    }
}
