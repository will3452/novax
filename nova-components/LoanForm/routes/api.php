<?php

use App\Models\Group;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::get('/boot', function () {
    $individual = User::whereNull('group_id')
    ->where('id', '!=', 1)
    ->get();

    $interests = Interest::get();
    $groups = Group::get();

    return [
        'individual' => $individual,
        'interests' => $interests,
        'groups' => $groups,
    ];
});
