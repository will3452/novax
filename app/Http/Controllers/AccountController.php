<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getAccount()
    {
        return view('get-account');
    }
}
