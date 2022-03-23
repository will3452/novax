<?php

namespace App\Helpers;

use App\Models\User;

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

    const forPartners = [
        User::TYPE_PARENT,
        User::TYPE_STUDENT,
        User::TYPE_TEACHER,
    ];

    const forAll = [
        User::TYPE_PARENT,
        User::TYPE_STUDENT,
        User::TYPE_TEACHER,
        User::TYPE_PARTNER,
    ];

    const forTeacher = [
        User::TYPE_PARENT,
        User::TYPE_STUDENT,
        User::TYPE_PARTNER,
    ];
}
