<?php

namespace App\Notifications;

use App\Models\Title;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GroupEndorseByAdviser extends Notification
{
    use Queueable;

    public $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Title $title)
    {
        $this->title = $title;
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
        $title = $this->title->title;
        return [
            'message' =>"Your group in \"$title\" has been endorsed by your adviser. please submit oral defense form to panelist.",
            'actions' => [
                [
                    'label' => 'Go to Title',
                    'action' => route('titles.show', $this->title->id) . "?tab=group",
                    'color' => 'btn-primary',
                ]
            ]
        ];
    }
}
