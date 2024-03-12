<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Api\ErrorHelper;
use App\Models\Alumnus;
use App\Models\ProfessionalRecord;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function register(Request $request)
    {
        $name = "$request->first_name $request->middle_name $request->last_name";
        $email = $request->email;
        $password = Str::random(8);

        // send to the email 
        Mail::raw("Your temporary password: $password", function ($message) use ($email) {
            $message->to($email)->subject('Temporary Password'); 
        }); 

        if (is_null($email)) {
            return ErrorHelper::sendError(400, 'field(s) are required!');
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            return ErrorHelper::sendError(400, 'email is already in used!');
        }

        if (strlen($password) <= 6) {
            return ErrorHelper::sendError(400, 'password is too short!');
        }

        $user = $this->createUser([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
        ]);

        $token = $this->createToken($user);

        // create alumni 
        $alumnus = Alumnus::create([
            'user_id' => $user->id, 
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'middle_name' => $request->middle_name, 
            'gender' => $request->gender, 
            'batch' => $request->batch, 
            'birthday' => $request->birthday, 
            'employment_status' => $request->employment_status, 
            'soc_med' => json_encode($request->soc_med), 
            'program' => $request->program, 
        ]); 


        foreach($request->records as $record) {
            ProfessionalRecord::create([
                'career' => $record['career'], 
                'alumnus_id' => $alumnus->id,
                'scope' => $record['scope'], 
                'work_type' => $record['work_type'], 
                'is_private' => $record['is_private'], 
                'is_aligned' => $record['is_aligned'], 
                'company' => $record['company'],
                'company_address' => $record['company_address'],
            ]); 
        }

        

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
}
