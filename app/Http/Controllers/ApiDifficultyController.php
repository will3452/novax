<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Difficulty;
use Illuminate\Http\Request;
use App\Http\Requests\IsDoneRequest;
use App\Http\Requests\MarkAsDoneRequest;

class ApiDifficultyController extends Controller
{
    public function index()
    {
        return [
            'difficulties' => Difficulty::get(),
        ];
    }

    public function markAsDone(MarkAsDoneRequest $request)
    {
       $request->validated();
        Module::find($request->module_id)->markAsDone();
        return 'done!';
    }

    public function isDone(MarkAsDoneRequest $request)
    {
        $request->validated();

       return optional(Module::find(request()->module_id))->isDone() ? 'true':'false';
    }
}
