<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\Question;
use App\Models\Room;
use App\Models\Subject;
use App\Models\User;
use App\Observers\ModuleObserver;
use App\Observers\QuestionObserver;
use App\Observers\RoomObserver;
use App\Observers\SubjectObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Room::observe(RoomObserver::class);
        Subject::observe(SubjectObserver::class);
        Module::observe(ModuleObserver::class);
        Question::observe(QuestionObserver::class);
    }
}
