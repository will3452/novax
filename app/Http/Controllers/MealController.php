<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealToday;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function createTodayMeal () {
        $data = ['user_id' => auth()->id(),];
        $userBmi = auth()->user()->getStatusBmi();
        $i = ['breakfast', 'supper', 'lunch', 'dinner'];
        foreach ($i as $ix) {
            $bs = Meal::whereType($ix)->whereIn('recommended_for', ['All', \Str::title($userBmi)])->inRandomOrder()->get();
            $data[$ix."_id"] = null;
            foreach ($bs as $item) {
                $not = 0; // flag
                $ai = explode('--', $item->allergen_information);
                foreach ($ai as $aItem) {
                    $aExists = auth()->user()->allergies()->where('name', 'LIKE', "%$aItem%")->exists();
                    if($aExists) {
                        $not++;
                    }
                }

                if ($not == 0) {
                    $data[$ix."_id"] = $item->id;
                    break;
                }
            }
        }

        MealToday::create($data);
    }

    public function index (Request $request) {
        $exists = MealToday::whereUserId(auth()->id())->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->exists();

        if (! $exists) {
            $this->createTodayMeal();
        }

        $today = MealToday::whereUserId(auth()->id())->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->latest()->first();

        return view('meal.index', compact('today'));
    }
}
