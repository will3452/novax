<?php

namespace App\Http\Conversations;

use App\Models\Conversation as ModelsConversation;
use App\Models\SubTopic;
use App\Models\Topic;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Exception;

class TopicConversation extends Conversation {

    public $topics = [];

    public $topic = null;

    public $cons = [];

    public function __construct($topic = null)
    {
        $this->topic = $topic;
    }

    public function selectSubTopics($topicId) {
        $subtopics = SubTopic::whereTopicId($topicId)->get();

        $buttons = [];

        foreach ($subtopics as $topic) {
            $buttons[] = (Button::create($topic->name))->value($topic->id);
        }

        $message = 'Things you want to know about the selected topic.';

        $this->log($message);

        $question = Question::create($message)
                ->addButtons($buttons);

        $this->ask($question, function ($answer) {
            $topicId = $answer->getValue();

            $topic = SubTopic::find($topicId);

            $this->log($topic->name, auth()->user()->name);

            $message = "$topic->name, $topic->description";
            $this->log($message);

            $this->say($message);

            $this->moreQuestion();
        });
    }

    public function moreQuestion () {

        $message = 'Do you have any more questions ?';

        $this->log($message);
        $question = Question::create($message)
            ->addButtons([
                Button::create('Yes')->value('yes'),
                Button::create('No more.')->value('no'),
            ]);

        $this->ask($question, function ($answer) {
            $answer = $answer->getValue();

            $this->log($answer, auth()->user()->name);

            if ($answer == 'yes') {
                $this->selectTopic($this->topics, 'Ok, plese select another topic.');
            } else {
                $this->say('Ok!');

                $this->saveConvo();
            }
        });
    }


    public function selectTopic($topics, $message = 'What topic would you like to know?') {
        $buttons = [];

        $this->log($message);

        foreach ($topics as $topic) {
            $buttons[] = (Button::create($topic->name))->value($topic->id);
        }

        $question = Question::create($message)
                ->addButtons($buttons);

        $this->ask($question, function ($answer) {
            try {
                $topicId = $answer->getValue();

                $topic = Topic::find($topicId);
                $this->log($topic->name, auth()->user()->name);

                if ($topic->subTopics()->count()) {
                    $message = "$topic->name, $topic->description";

                    $this->log($message);

                    $this->say($message);

                    $this->selectSubTopics($topicId);
                } else {
                    $this->moreQuestion();
                }
            } catch (Exception $e) {
                $this->say('Sorry I can\'t process.');
            }
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


        if ($this->topic != null) {
           $topic = Topic::whereName($this->topic)->first();

           $this->selectSubTopics($topic->id);
        } else {
            $this->topics = Topic::latest()->get();
            $this->selectTopic($this->topics);
        }

    }

}
