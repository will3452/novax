<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function showNotification()
    {
        return view('notifications');
    }

    public function markAsRead($id)
    {
        auth()->user()->unreadNotifications()->where('id', $id)->first()->markAsRead();
        return response([
            'result'=>'success'
        ], 200);
    }
}
