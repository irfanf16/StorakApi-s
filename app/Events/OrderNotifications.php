<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderNotifications Implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vendor_id;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($vendor_id)
    {
        $this->vendor_id = $vendor_id;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('order-notifications');
    }


    public function broadcastAs()
    {
        return 'orders';
    }


}