<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\MuscleGroup;
use App\Models\UserModule;
use Illuminate\Http\Request;

class ApiStatController extends Controller
{
    public function index()
    {
       $groups = MuscleGroup::get()->pluck('description');

       $result = [];

       foreach ($groups as $group) {
           $exercisesIds = Exercise::whereMuscleGroup($group)->get()->pluck('id');
           $result[] = UserModule::whereUserId(auth()->id())->whereIn('module_id', $exercisesIds)->count();
       }

       return [
           'keys' => $groups,
           'values' => $result
       ];
    }
}
