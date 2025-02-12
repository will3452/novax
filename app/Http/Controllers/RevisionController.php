<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function store (Request $request) {
        $data = $request->validate([
            'revision' => ['required'],
            'group_id' => ['required'],
            'faculty_id' => ['required'],
        ]);

        Revision::create($data);

        alert()->success('Success', "Revision has been added!");
        return back();
    }
}
