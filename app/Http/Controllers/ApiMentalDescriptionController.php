<?php

namespace App\Http\Controllers;

use App\Models\MentalDescription;
use Illuminate\Http\Request;

class ApiMentalDescriptionController extends Controller
{
    public function index()
    {
        return [
            'mental_descriptions' => MentalDescription::get(),
        ];
    }
}
