<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if( auth()->user()->hasRole(Role::SUPERADMIN) ) {
            return redirect(Nova::path());
        }
        return view('home');
    }
}
