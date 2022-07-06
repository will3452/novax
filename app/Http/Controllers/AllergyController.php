<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    public function deleteAllergies() {
        Allergy::whereUserId(auth()->id())->each(fn($e)=>$e->delete());
    }

    public function save (Request $request) {
        $this->deleteAllergies();
        foreach ($request->allergies as $item) {
            auth()->user()->allergies()->create(['name' => $item]);
        }
        auth()->user()->deleteMealToday();
        return auth()->user()->allergies;
    }
}
