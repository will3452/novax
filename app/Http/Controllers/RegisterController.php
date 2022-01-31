<?php

namespace App\Http\Controllers;

use App\Models\Aan;
use App\Models\User;
use App\Models\Interest;
use App\Helpers\FileHelper;
use App\Helpers\FormHelper;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Laravel\Nova\Nova;

class RegisterController extends Controller
{
    public function registerScholar()
    {
        return view('register_scholar');
    }

    public function registerScholarPost(UserRequest $request)
    {
        $validated = $request->validated();

        //save picture
        $validated['picture'] = FileHelper::save($request->picture);

        //this will hold the interest of the user that will be created later,
        $interestField = [
            'course_id' => $validated['course'],
            'college_id' => $validated['college'],
            'club_id' => $validated['club'],
        ];

        $aan = $validated['aan'];

        //this will remove the excess fields
        $userFields = FormHelper::removeDataWithKeys(
            [
                'course',
                'college',
                'club',
                'aan',
            ],
            $validated
        );

        //this will create a fields
        $user = User::create($userFields);

        //turn the aan into unavailable
        Aan::whereValue($aan)
            ->first()
            ->update(['user_id' => $user->id]);

        //create interest of the newly created user
        $interestField['user_id'] = $user->id;
        Interest::create($interestField);

        //log the user in
        auth()->login($user);
        return redirect(Nova::path());
    }
}
