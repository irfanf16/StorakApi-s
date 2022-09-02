<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVendorEmail extends Mailable
{
    use Queueable, SerializesModels;

    // PACKAGE DETAILS
    public  $package_details;
    
    
    // CREATE A NEW INSTANCE
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
                    ->subject($subject = "Congrats ". $this->package_details->storeDetail->store_name . " you have received a new order - Order No " . $this->package_details->orderDetail->order_no)
                    ->view('email.sendVendorEmail');
    }
}