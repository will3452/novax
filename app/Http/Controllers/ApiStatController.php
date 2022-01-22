<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Instruction;
use App\Models\Module;
use App\Models\MuscleGroup;
use App\Models\UserModule;
use Illuminate\Http\Request;

class ApiStatController extends Controller
{
    public function workOuts()
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

    public function meals()
    {
        $keys = collect(Instruction::MEAL_TYPE_OPTIONS)->keys();
        $values = [];
        foreach ($keys as $key) {
            $ids = UserModule::whereUserId(auth()->id())->get()->pluck('module_id');
            $modulesId = Module::whereIn('id', $ids)->whereType(Module::TYPE_MEAL)->get()->pluck('id');
            $values[] = Instruction::whereMealType($key)->whereIn('module_id', $modulesId)->sum();
        }
        return [
            'keys' => $keys,
            'values' => $values,
        ];
    }
    public function index()
    {
       if (request()->has('type') && request()->type === 'meal') {
           $this->meals();
       } else {
           $this->workOuts();
       }
    }
}
