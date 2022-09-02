<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $pass;
    public function __construct($email,$pass)
    {
        $this->email=$email;
        $this->pass=$pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = 'dev.kashifsandhu@gmail.com', $name = 'Storak.qa')->subject('Account Create')->markdown('mail.user-account');
    }
}
