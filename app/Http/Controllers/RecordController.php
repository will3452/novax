<?php

namespace App\Http\Controllers;

use App\Helpers\Model;
use App\Models\Material;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function updateScore(Request $request, Record $record)
    {
        $data = $request->validate([
            'score' => 'required',
        ]);

        $record->update($data);

        return back()->withSuccess('Score updated!');
    }
    public function show($type, $id)
    {
        $model = Model::getFullModel($type)::findOrFail($id);
        $records = $model->records;
        return view('record.show', compact('records', 'model'));
    }

    public function record($type, $id , $userId)
    {
        $recordable = (Model::getFullModel($type))::find($id);

        if (! $recordable->hasRecordOfUser($userId)) {
            //create user record now
            $recordable->records()->create([
                'user_id' => $userId,
            ]);
        }

        return $recordable;
    }
    public function saveRecord($type, $id, $userId = null)
    {
        if (is_null($userId)) {
            $userId = auth()->id();
        }

        $lastInModule = request()->has('last-in-module');

        if ($lastInModule) {
            $this->record("Module", request()->get('last-in-module'), $userId);
        }

        //check if the users has records and record if has not
        $recordable = $this->record($type, $id, $userId);

        // the callback/redirect
        $cb = "";

        if (Model::getFullModel($type) === "\\" . Material::class) {
            $cb = $recordable->link;
        } else {
            $activityCategory = $recordable->category;
            $cb = "/take/$activityCategory/$id";
        }

        return redirect()->to($cb);
    }
}
