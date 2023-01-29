<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
     /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

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
