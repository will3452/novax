<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;
    public $status;
    public $appointment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment, string $status)
    {
        $this->status = $status;
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('appointment-status');
    }
}
