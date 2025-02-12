<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\OralDefenseRequest;
use App\Models\User;
use App\Models\Title;
use App\Models\Panellist;
use Illuminate\Http\Request;
use App\Models\TitleApplication;
use App\Notifications\GroupEndorseByAdviser;

class TitleController extends Controller
{
    public function show(Request $request, Title $title) {
        return view('titles.show', compact('title'));
    }


    public function setVerdict(Request $request, Title $title) {
        return view('titles.set-verdict', compact('title'));
    }

    public function storeVerdict(Request $request) {
        $group = Group::find($request->group_id);
        $group->update(['verdict' => $request->verdict]);
        alert()->success('Success', 'Verdict has been set!');
        return redirect()->to(route('titles.show', $group->title) . '?tab=group');
    }



    public function submitOral(Request $request, Title $title, OralDefenseRequest $oral) {
        $group = $title->group;
        $oral->update(['status' => OralDefenseRequest::PANELIST_APPROVAL]);
        $date = $oral->date;
        $venue = $oral->venue;
        $time = $oral->time;
        foreach ($group->panellists as $p) {
            $group->task()->create([
                'user_id' => $p->faculty_id,
                'description' => "The group $group->code is requesting to schedule their oral defense on $date, at $time in $venue.",
                'approved_status' => 'Ready for defense(Coordinator approval)',
            ]);
        }

        alert()->success("Success", "Oral Defense Form has been submitted!");
        return back();
    }

    public function endorse(Request $request, Title $title) {
        $request->validate([
            'date' => ['required'],
            'time' => ['required'],
            'venue' => ['required'],
        ]);
        $group = $title->group;
        $group->update(['status' => Group::FOR_DEFENSE]);
        foreach($group->groupMembers as $member) {
            User::find($member->student_id)->notify(new GroupEndorseByAdviser($title));
        }

        OralDefenseRequest::create([
            'group_id' => $group->id,
            'section_id' => $title->section_id,
            'time' => $request->time,
            'date' => $request->date,
            'venue' => $request->venue,
            'status' => OralDefenseRequest::SUBMIT_ORAL_DEFENSE,
        ]);

        alert()->success('Success', 'Group has been endorsed.');

        return back();
    }
    public function removePanelist(Request $request, Title $title) {
        $request->validate([
            'faculty_id' => ['required'],
        ]);

        $p = Panellist::whereFacultyId($request->faculty_id)->whereStatus('PENDING')->whereGroupId($title->group->id)->first();
        $p->task()->first()->delete();
        $p->delete();

        alert()->success('Success', 'Invitation has been deleted!');
        return back();
    }

    public function addPanelist(Request $request, Title $title) {
        $request->validate([
            'faculty_id' => ['required'],
        ]);
        foreach ($request->faculty_id as $user_id) {
            $p = Panellist::create([
                'status' => 'PENDING',
                'faculty_id' => $user_id,
                'group_id' => $title->group->id,
                'type' => $request->type,
            ]);

            $p->task()->create([
                'user_id' => $user_id,
                'description' => "You are invited to be a $request->type panelist for the title \"$title->title\"",
                'approved_status' => 'APPROVED',
            ]);
        }

        alert()->success('Success', 'Invitation has been sent!');

        return back();

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
            'user_id' => $title->faculty_id,
            'description' => "[Title Application] \"$user\"is applying for the title \"$title->title\". ",
            'approved_status' => 'APPROVED',
        ]);

        alert()->success('Success', 'Application has been submitted!');
        return back();

    }
    public function lockPanelist(Request $request, Title $title) {
        $title->group->update(['status' => 'For Coordinator Approval']);
        $title->group->task()->create([
            'approved_status' => 'For Dean Approval',
            'user_id' => nova_get_setting('coordinator_id', User::first()->id),
            'description' => "[Group Approval] The group \"$title->title\" wants to get approved."
        ]);
        alert()->success('Success', 'Panelist locked, Group is for Coordinator approval.');
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
