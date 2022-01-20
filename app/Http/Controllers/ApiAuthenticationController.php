<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Api\ErrorHelper;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticationController extends Controller
{
    public function createToken(User $user, $tokenName = 'DEFAULT_APP')
    {
        $token = $user->createToken($tokenName);
        return $token->plainTextToken;
    }
    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function register(UserRegisterRequests $request)
    {
        $name = $request->name ?? 'client_' . uniqid();
        $username = $request->username;
        $gender = $request->gender;
        $birthDay = $request->birth_day;
        $email = $request->email ?? "$name@example.com";
        $password = $request->password;

        if (is_null($name) || is_null($email) || is_null($password) || is_null($username) || is_null($gender) || is_null($birthDay)) {
            return ErrorHelper::sendError(400, 'field(s) are required!');
        }

        $user = User::where('username', $username)->first();

        if ($user) {
            return ErrorHelper::sendError(400, 'username is already in used!');
        }

        if (strlen($password) <= 6) {
            return ErrorHelper::sendError(400, 'password is too short!');
        }

        $user = $this->createUser([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'gender' => $gender,
            'birth_day' => $birthDay,
            'password' => $password,
        ]);

        $token = $this->createToken($user);

        return response([
            'user'=>$user,
            'token'=>$token,
        ], 200);
    }

    public function login(UserLoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;


        if (is_null($username) || is_null($password)) {
            return ErrorHelper::sendError(400, 'field(s) are required!');
        }

        $user = User::where('username', $username)->first();

        if (is_null($user)) {
            return ErrorHelper::sendError(404, 'user not found!');
        }

        if (!Hash::check($password, $user->password)) {
            return ErrorHelper::sendError(400, 'Wrong credentials!');
        }
        $token = $this->createToken($user);
        return response([
            'user'=>$user,
            'songs_of_nature' => nova_get_setting('song_of_nature_link', 'https://www.youtube.com/channel/UC_nnhTXgKPjZjYb_8l3ebbw'),
            'meditation' => nova_get_setting('meditation_link', 'https://www.youtube.com/watch?v=cQm8mhwezd4'),
            'token'=>$token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message'=>"LOGOUT SUCCESS!",
        ], 200);
    }
}
