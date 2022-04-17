<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiFollowController extends Controller
{
    public function follow(User $store)
    {
        $data = ['store_id' => $store->id];

        auth()->user()->followings()->create($data);

        return response(['ok'], 200);
    }

    public function unfollow(User $store)
    {
        auth()->user()->followings()->where('store_id', $store->id)->first()->delete();

        return response(['ok'], 200);
    }
}
