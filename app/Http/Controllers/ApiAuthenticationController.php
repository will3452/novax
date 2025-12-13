<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\BarangayAccess;
use App\Models\BarangayProfile;
use App\Models\Profile;
use App\Models\User;
use App\Api\ErrorHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticationController extends Controller
{
    public function createToken(User $user, $tokenName = "DEFAULT_APP")
    {
        $token = $user->createToken($tokenName);
        return $token->plainTextToken;
    }
    public function createUser($data)
    {
        $data["password"] = bcrypt($data["password"]);
        return User::create($data);
    }

    public function register(Request $request)
    {
        $first_name = $request->firstName;
        $last_name = $request->lastName;
        $middle_name = $request->middleName;
        $suffix = $request->suffix;
        $birth_date = $request->birthDate;
        $barangay_id = $request->barangay_id;
        $email = $request->email;
        $password = $request->password;
        $agreeToPrivacyPolicy = $request->agreeToPrivacyPolicy;
        $gender = $request->gender;
        $name = trim(
            $first_name . " " . $last_name . " " . $middle_name . " " . $suffix,
        );

        $barangay = Barangay::find($barangay_id);

        if (!$agreeToPrivacyPolicy) {
            return ErrorHelper::sendError(
                400,
                "You must agree to the privacy policy!",
            );
        }

        if (is_null($name) || is_null($email) || is_null($password)) {
            return ErrorHelper::sendError(400, "field(s) are required!");
        }

        $user = \App\Models\User::where("email", $email)->first();

        if ($user) {
            return ErrorHelper::sendError(400, "email is already in used!");
        }

        if (strlen($password) <= 6) {
            return ErrorHelper::sendError(400, "password is too short!");
        }

        $user = $this->createUser([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "role" => User::ROLE_RESIDENT,
        ]);

        Profile::create([
            "first_name" => $first_name,
            "last_name" => $last_name,
            "middle_name" => $middle_name,
            "suffix" => $suffix,
            "birth_date" => $birth_date,
            "gender" => $gender,
            "address" => $barangay->address_line,
            "user_id" => $user->id,
        ]);

        // link barangay to user
        BarangayAccess::create([
            "barangay_id" => $barangay->id,
            "user_id" => $user->profile->id,
            "type" => "Resident",
        ]);

        // link barangay to profile
        BarangayProfile::create([
            "barangay_id" => $barangay->id,
            "profile_id" => $user->profile->id,
        ]);

        $token = $this->createToken($user);

        return response(
            [
                "user" => $user,
                "token" => $token,
                "profile" => $user->profile,
            ],
            200,
        );
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $barangayId = $request->barangay;

        if (is_null($email) || is_null($password)) {
            return ErrorHelper::sendError(400, "field(s) are required!");
        }

        $barangay = Barangay::find($barangayId);

        $user = User::where("email", $email)->first();

        $user->load(["events"]);

        activity()
            ->withProperties([
                "icon" => "lucide:shield-alert",
            ])
            ->causedBy($user)
            ->log("You logged in");

        if (is_null($user)) {
            return ErrorHelper::sendError(404, "user not found!");
        }

        if (!Hash::check($password, $user->password)) {
            return ErrorHelper::sendError(400, "Wrong credentials!");
        }
        $token = $this->createToken($user);
        return response(
            [
                "user" => $user,
                "token" => $token,
                "barangay" => $barangay,
            ],
            200,
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        activity()
            ->withProperties([
                "icon" => "lucide:shield-alert",
            ])
            ->causedBy($request->user())
            ->log("You logged out");
        return response(
            [
                "message" => "LOGOUT SUCCESS!",
            ],
            200,
        );
    }
}
