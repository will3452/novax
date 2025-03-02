<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentJoinedSectionNotification extends Notification
{
    use Queueable;
    public $course;
    public $section;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Course $course, Section $section)
    {
        $this->course = $course;
        $this->section = $section;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $courseName = $this->course->name;
        $sectionId = $this->section->id;
        $sectionName = $this->section->section;
        return [
            'message' => "We’re pleased to inform you that you have been successfully joined to the $courseName – Section $sectionName by your course coordinator." ,
            'actions' => [
                [
                    "label" => "View Sections",
                    "action" => route('sections.show', $sectionId),
                    "color" => "btn-primary"
                ]
            ]
        ];
    }
}
