<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index () {
        return view('notifications.index');
    }

    public function read(Request $request, $n) {
        auth()->user()->notifications()->find($n)->markAsRead();
        alert()->success('Success', 'Done!');
        return back();
    }

    public function readAll(Request $request) {
        foreach(auth()->user()->notifications as $n) {
            $n->markAsRead();
        }
        alert()->success('Success', 'Done!');
        return back();
   }
}
