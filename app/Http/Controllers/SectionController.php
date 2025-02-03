<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Notifications\StudentJoinedSectionNotification;

class SectionController extends Controller
{
    public function index(Request $request) {
        $sections = Section::latest()->get();
        if (auth()->user()->isStudent()) {
            $sections = auth()->user()->sections()->latest()->get();
        }
        return view('sections.index', compact('sections'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'term' => ['required'],
            'school_year' => ['required'],
            'section' => ['required'],
            'no_of_students' => '',
            'creator_id' => '',
            'course_id' => ['required'],
            'ic_type' => ['required'],
            'thesis_phase' => ['required'],
        ]);

        $data['pass_code'] = 'test';

        Section::create($data);
        alert()->success('Success', 'Section has been created!');
        return back();
    }

    public function show(Request $request, Section $section) {

        return view('sections.show', compact('section'));
    }

    public function removeStudent(Request $request) {
        $data = $request->validate([
            'student_id' => 'required',
            'section_id' => 'required',
        ]);

        SectionStudent::whereStudentId($data['student_id'])->whereSectionId($data['section_id'])->delete();
        alert()->success('Success', 'Student has been removed!');
        return back();
    }

    public function addStudent(Request $request) {
        $data = $request->validate([
            'section_id' => 'required',
            'student_id' => 'required',
        ]);

        foreach ($data['student_id'] as $key => $value) {
            SectionStudent::create([
                'student_id' => $value,
                'section_id' => $data['section_id'],
                'status' => 'JOINED',
            ]);

            $section = Section::find($data['section_id']);

            User::find($value)->notify(new StudentJoinedSectionNotification($section->course, $section));
        }
        alert()->success('Success', 'Student has been added');


        return back();
    }
}
