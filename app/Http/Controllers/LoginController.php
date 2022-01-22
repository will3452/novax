<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Controllers\LoginController as ControllersLoginController;

class LoginController extends ControllersLoginController {
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            if(! auth()->user()->hasRole(Role::SUPERADMIN)) {
                auth()->logout();
                $path = Nova::path();
                return "you are not authorized! <a href='$path'>go back</a>";
            }

            return $this->sendLoginResponse($request);
        }
    }
}
