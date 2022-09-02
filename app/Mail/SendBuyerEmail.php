<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBuyerEmail extends Mailable
{
    use Queueable, SerializesModels;

    // ORDER DETAILS
    public  $order_details;

    // CREATE A NEW MESSAGE INSTANCE
    public function __construct($order_details)
    {
        $this->order_details = $order_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = 'dev.kashifsandhu@gmail.com', $name = 'Storak.qa')
                    ->subject($subject = "Thank You " . $this->order_details->user->name . " your order has been placed - Order No " . $this->order_details->order_no)
                    ->view('email.sendBuyerEmail');
    }
}