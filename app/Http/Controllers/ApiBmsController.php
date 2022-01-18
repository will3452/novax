<?php

namespace App\Http\Controllers;

use App\Http\Requests\BmsCreateRequest;
use App\Http\Requests\BmsRequest;
use App\Models\Bms;
use Illuminate\Http\Request;

class ApiBmsController extends Controller
{
    public function index(BmsRequest $request)
    {
        $user = auth()->user();
        $response = null;
        if ($request->has('type')) {
            $response = $user->bms()->whereType($request->type)->get();
        } else {
            $response = $user->bms()->get();
        }

        return $response;
    }

    public function create(BmsCreateRequest $request)
    {
        $user = auth()->user();
        $payload = $request->validated();

        $payload['age'] = is_null($user->birth_day) ? 12 : \Carbon\Carbon::parse($user->birth_day)->age;
        $payload['user_id'] = $user->id;

        return Bms::create($payload);
    }
}
