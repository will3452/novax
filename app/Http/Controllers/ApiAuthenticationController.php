<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Api\ErrorHelper;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SubmitCodeRequest;
use App\Http\Requests\VerificationCodeRequest;
use App\Models\VerificationCode;
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

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->createUser($data);

        $token = $this->createToken($user);

        return response([
            'user'=>$user,
            'token'=>$token,
        ], 200);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;


        if (is_null($email) || is_null($password)) {
            return ErrorHelper::sendError(400, 'field(s) are required!');
        }

        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            return ErrorHelper::sendError(404, 'user not found!');
        }

        if (!Hash::check($password, $user->password)) {
            return ErrorHelper::sendError(400, 'Wrong credentials!');
        }
        $token = $this->createToken($user);
        return response([
            'user'=>$user,
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

    public function requestVerificationCode(VerificationCodeRequest $request)
    {
        $data = $request->validated();

        if ($data['type'] === 'email') {
            return 'not available';
        }

        VerificationCode::smsHandler($data['contact']);

        return response([
            'message' => 'ok',
        ], 200);
    }

    public function submitCode(SubmitCodeRequest $request)
    {
        $request->validated();

        $vCode = VerificationCode::whereCode($request->code)
            ->whereRecipient($request->recipient)->latest()->first();

        $vCode->update(['status' => VerificationCode::STATUS_USED]);
        if ($request->type === 'email') {
            return 'not available';
        }

        User::wherePhone($request->contact)->first()->update([
            'phone_verified_at' => now(),
        ]);

        return response([
            'message' => 'ok'
        ], 200);
    }
}
