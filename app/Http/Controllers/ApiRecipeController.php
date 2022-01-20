<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class ApiRecipeController extends Controller
{
    public function index()
    {
        return [
            'recipes' => Recipe::get(['id', 'name']),
        ];
    }

    public function show(Recipe $recipe)
    {
        return [
            'recipe' => $recipe,
        ];
    }
}
