<?php

namespace App\Observers;

use App\Models\Meal;

class MealObserver
{
    public function creating(Meal $meal) {
        $allergies = json_decode($meal->allergen_information);
        $meal->allergen_information = implode('--', $allergies);
    }

    public function updating(Meal $meal) {
        $allergies = json_decode($meal->allergen_information);
        $meal->allergen_information = implode('--', $allergies);
    }
}
