<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    // PACKAGE DETAILS
    public  $package_details;

    // Create a new message instance.
    public function __construct($package_details)
    {
        $this->package_details = $package_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = 'dev.kashifsandhu@gmail.com', $name = 'Storak.qa')
                    ->subject($subject = "Your Order " . $this->package_details->orderDetail->order_no .  " has been " .$this->package_details->orderStatusDetail->status)
                    ->view('email.orderStatus');
    }
}