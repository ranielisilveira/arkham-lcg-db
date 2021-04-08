<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserChangePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $user)
    {
        $this->url = $url;
        $this->user = $user;
        $this->subject = 'Recuperação de Senha - ' . env('APP_NAME');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.user-change-password');
    }
}
