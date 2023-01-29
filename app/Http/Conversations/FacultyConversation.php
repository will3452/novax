<?php

namespace App\Http\Conversations;

use App\Models\Conversation as ModelsConversation;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\MessageRequest;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;


class FacultyConversation extends Conversation {

    public $departments = [];

    public $cons = [];


    public function selectFaculty($depId) {
        $faculties = Faculty::whereDepartmentId($depId)->latest()->get();

        $buttons = [];

        foreach ($faculties as $f) {
            $buttons[] = Button::create($f->name)->value($f->id);
        }

        $message = 'Choose who you want to talk to.';

        $this->log($message);

        $question = Question::create($message)
            ->addButtons($buttons);

        $this->ask($question, function ($answer) {
            $answer = $answer->getValue();
            $f = Faculty::find($answer);
            $this->log($f->name, auth()->user()->name);
            $this->processMessage($answer);
        });

    }

    public function processMessage($fId) {
        // send message

        MessageRequest::create([
            'user_id' => auth()->id(),
            'faculty_id' => $fId,
        ]);

        $message = "Ok, I've already submitted a request so you can talk to your chosen faculty. Thank you";

        $this->log($message);

        $this->say($message);

        $this->saveConvo();
    }

    public function showDepartments() {
        $buttons = [];


        foreach ($this->departments as $dep) {
            $buttons[] = Button::create($dep->name)->value($dep->id);

        }

        $message = 'Please select departments';

        $this->log($message);

        $question = Question::create($message)
            ->addButtons($buttons);

        $this->ask($question, function($answer) {
            $answer = $answer->getValue();
            $d = Department::find($answer);
            $this->log($d->name, auth()->user()->name);
            $this->selectFaculty($answer);
        });
    }

    public function log($message, $from = "bot") {
        $this->cons[] = $from . " : " . $message;
    }

    public function saveConvo() {
        if (auth()->check()) {
            $cons = implode(ModelsConversation::SP, $this->cons);
            ModelsConversation::create(['messages' => $cons, 'user_id' => auth()->id()]);
        }
    }


    public function run () {

        $this->cons = [];

        $this->departments = Department::whereHas('faculties')->latest()->get();

        $this->showDepartments();
    }
}
