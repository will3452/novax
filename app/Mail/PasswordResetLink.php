<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\PasswordResetLink as ModelPasswordResetLink;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetLink extends Mailable
{
    use Queueable, SerializesModels;

    public $passwordResetLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModelPasswordResetLink $passwordResetLink)
    {
        $this->passwordResetLink = $passwordResetLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.password-reset-link');
    }
}
