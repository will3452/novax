<?php

namespace App\Http\Controllers;

use App\Models\Difficulty;
use App\Models\Module;
use Illuminate\Http\Request;

class ApiDifficultyController extends Controller
{
    public function index()
    {
        return Difficulty::get();
    }

    public function markAsDone()
    {
        request()->validate([
            'module_id' => 'required',
        ]);
        Module::find(request()->module_id)->markAsDone();
        return 'done!';
    }

    public function isDone()
    {
       request()->validate([
           'module_id' => 'required',
       ]);

       return optional(Module::find(request()->module_id))->isDone() ? 'true':'false';
    }
}
