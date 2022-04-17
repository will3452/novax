<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiNotificationController extends Controller
{
    public function getNotifications()
    {
        $ns = auth()->user()->unreadNotifications;
        foreach ($ns as $n) {
            $n->markAsRead();
        }

        return $ns;
    }
}
