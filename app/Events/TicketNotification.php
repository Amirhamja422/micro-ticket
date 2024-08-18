<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //

        $this->name = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn() :array
    // {
    //     // return new PrivateChannel('channel-name');
    //     return ['my-channel'];
    // }

    public function broadcastOn()
    {
        return new Channel('my-channel');
    }


    public function broadcastAs()
    {
        return 'form-submitted';

    }

}

