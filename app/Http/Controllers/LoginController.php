<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Nova\Http\Controllers\LoginController as ControllersLoginController;

class LoginController extends ControllersLoginController
{
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        auth()->user()->update([
            'last_login_at' => now(),
        ]);

        if ($response = $this->authenticated($request, $this->guard()->user())) {

            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
}
