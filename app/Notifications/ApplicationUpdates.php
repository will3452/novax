<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationUpdates extends Notification
{
    use Queueable;

    public $jobApplication;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
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
        if ($this->jobApplication->status === JobApplication::STATUS_ACCEPTED) {
            return [
                'message' => 'Good News! your application to '. $this->jobApplication->jobOffer->position.' has been accepted!',
                'job_application_id' => $this->jobApplication->id,
            ];
        }
        if ($this->jobApplication->status === JobApplication::STATUS_DECLINED) {
            return [
                'message' => 'your application to '. $this->jobApplication->jobOffer->position.' has been declined. (T_T)',
                'job_application_id' => $this->jobApplication->id,
            ];
        }
        if ($this->jobApplication->status === JobApplication::STATUS_INTERVIEW) {
            return [
                'message' => 'Good News! You are in interview process for the position '. $this->jobApplication->jobOffer->position.', Good luck. '. $this->jobApplication->jobOffer->employer->name.' will contact you, so please check you\'re  phone/email time to time.',
                'job_application_id' => $this->jobApplication->id,
            ];
        }
    }
}
