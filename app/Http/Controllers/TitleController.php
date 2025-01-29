<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\TitleApplication;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function show(Request $request, Title $title) {
        return view('titles.show', compact('title'));
    }
    public function apply(Request $request, Title $title) {
        $ta = TitleApplication::create([
            'student_id' => auth()->id(),
            'title_id' => $title->id,
            'section' => $title->section_id,
            'status' => 'PENDING',
        ]);
        $user = auth()->user()->name;

        $ta->task()->create([
            'user_id' => nova_get_setting('coordinator_id', 1),
            'description' => "[Title Application] \"$user\"is applying for the title \"$title->title\". ",
            'approved_status' => 'APPROVED',
        ]);
        alert()->success('Success', 'Application has been submitted!');
        return back();

    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => ['required', 'min:6'],
            'description' => ['required'],
            'faculty_id' => ['required'],
            'type' => '',
            'no_of_students' => ['required'],
            'area_of_research' => ['required'],
            'ic_type' => ['required'],
            'status' => '',
            'section_id' => ['required'],
            'file' => ['file'],
            'created_by_id' => ['required']
        ]);

        $of = $request->file->store('public');
        $fr = explode('/', $of);
        $file = end($fr);
        $data['file'] = $file;

        $data['type'] = in_array(auth()->user()->type, ['Faculty', 'Dean']) ? 'FACULTY' : 'STUDENT';
        $data['status'] = 'FOR COORDINATOR APPROVAL';
        Title::create($data);

        alert()->success('Success', 'Title has been submitted, please wait for coordinator to be approved.');

        return back();
    }
}
