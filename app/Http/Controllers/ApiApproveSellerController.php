<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ApproveSellerRequest;

class ApiApproveSellerController extends Controller
{
    public function approve(ApproveSellerRequest $r)
    {
        $r->validated();
        return User::whereId($r->user_id)->first()->update(['approved_as_store_owner_at' => now()]);
    }
}
