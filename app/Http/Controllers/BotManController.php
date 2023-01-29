<?php

namespace App\Http\Controllers;

use App\Http\Conversations\FacultyConversation;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Http\Conversations\TopicConversation;
use BotMan\Middleware\DialogFlow\V2\DialogFlow;

class BotManController extends Controller
{
     /**
     * Place your BotMan logic here.
     */
    public function handle()
    {

        $botman = app('botman');

        $dialogflow = DialogFlow::create('en');

        $botman->middleware->received($dialogflow);

        $botman->hears('input.connect', function ($bot) {
            $extras = $bot->getMessage()->getExtras();
            $bot->reply($extras['apiReply']);
        })->middleware($dialogflow);


        // faculty

        $botman->hears('input.faculties', function ($bot) {

            $bot->startConversation(new FacultyConversation());

        })->middleware($dialogflow);


        $botman->hears('input.welcome', function ($bot) {
            $extras = $bot->getMessage()->getExtras();
            $bot->reply($extras['apiReply']);
        })->middleware($dialogflow);

        $botman->hears('topic:{topic}', function($bot, $topic) {
            $bot->startConversation(new TopicConversation($topic));
        });

        $botman->hears('input.topic', function ($bot) {
            $bot->startConversation(new TopicConversation());
        })->middleware($dialogflow);


        $botman->hears('smalltalk.(.*)', function ($bot) {
            $extras = $bot->getMessage()->getExtras();
            $bot->reply($extras['apiReply']);
        })->middleware($dialogflow);


        $botman->fallback(function ($bot) {
            $bot->reply('Sorry I can\'t process your request.');
        });


        // $botman->hears('{message}', function($botman, $message) {

        //     if ($message == 'hi') {
        //         $this->askName($botman);
        //     }else{
        //         $botman->reply("write 'hi' for testing...");
        //     }

        // });

        $botman->listen();
    }
}
