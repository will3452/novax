<?php

namespace App\Http\Controllers;

use Str;
use App\Models\Meal;
use App\Models\MealToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MealController extends Controller
{
    public function createTodayMeal () {
        $data = ['user_id' => auth()->id(),];
        $userBmi = Str::title(auth()->user()->getStatusBmi());
        $i = ['breakfast', 'supper', 'lunch', 'dinner'];
        foreach ($i as $ix) {
            // $bs = Meal::whereType($ix)->whereIn('recommended_for', ['All', \Str::title($userBmi)])->inRandomOrder()->get();
            $except = '';
            $allergies = auth()->user()->allergies->pluck(['name'])->all();
            if (count($allergies)) {
                $except = 'AND ( ';
            }
            foreach ($allergies as $key=>$val) {
                $except .= " allergen_information LIKE '%$val%' ";
                if ($key != (count($allergies)-1)) {
                    $except .= 'OR';
                } else {
                    $except .= ' )';
                }
            }
            $query = DB::select(DB::raw("SELECT id FROM meals WHERE (type = '$ix') AND (recommended_for = 'All' OR recommended_for = '$userBmi') $except"));

            $data[$ix."_id"] = null;

            if (count ($query)) {
                $data[$ix.'_id'] = $query[rand(0, count($query) - 1)]->id;
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


    public function index1 (Request $request) {
        try {
            $exists = MealToday::whereUserId(auth()->id())->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->exists();

            if (! $exists) {
                $this->createTodayMeal();
            }

            $today = MealToday::whereUserId(auth()->id())->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->latest()->first();

            return view('meal.index', compact('today'));
        } catch(\Exception $e) {
            toast('something went wrong');
            return back();
        }
    }

    public function generate(Request $request) {
        try {
            $this->createTodayMeal();
            $today = MealToday::whereUserId(auth()->id())->whereDate('created_at', '=', \Carbon\Carbon::today()->format('Y-m-d'))->latest()->first();

            return view('meal.index', compact('today'));
        } catch(\Exception $e) {
            toast('something went wrong');
            return back();
        }
    }
}
