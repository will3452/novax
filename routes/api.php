<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Favorite;
use App\Models\Message;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::prefix('messages')->group(function () {
        Route::post('/', function (Request $request) {

            $data = $request->validate([
                'conversation_id' => 'required',
                'content' => 'required',
            ]);

            $data['user_id'] = auth()->id();

            return Message::create($data);
        });
    });

    Route::prefix('conversations')->group(function () {

        Route::get('/me', function () {
            return auth()->user()->conversations()->latest()->get();
        });

        Route::get('/:conversation', function (Request $request, Conversation $conversation) {
            return $conversation;
        });

        Route::post('/', function (Request $request) {
            $data = $request->validate([
                'name' => 'required',
            ]);

            $exists = Conversation::where($data)->first();

            if ($exists) {
                return $exists;
            }

            $conversation = Conversation::create($data);
            //join user
            ConversationUser::create(['conversation_id' => $conversation->id, 'user_id' => auth()->id()]);
            //join admin
            ConversationUser::create(['conversation_id' => $conversation->id, 'user_id' => 1]); // 1 will be the admin

            Message::create(['conversation_id' => $conversation->id, 'content' => 'Hello, I want to adopt the pet.', 'user_id' => auth()->id()]);

            $conversation->load('messages');
            return $conversation;
        });
    });

    Route::prefix('pets')->group(function () {
        Route::get('/', function (Request $request) {
            return Pet::whereDoesntHave('adopt')->get();
        });

        Route::post('/add-to-fav', function (Request $request) {
            return Favorite::create(['pet_id' => $request->pet_id, 'user_id' => auth()->id()]);
        });
    });
});

Route::get('/public-test', function () {
    return 'public test';
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
