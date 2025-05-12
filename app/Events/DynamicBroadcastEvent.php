<?php

namespace App\Events;

use App\Helper\ApiEncResponse;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DynamicBroadcastEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $channel;


    public function __construct($data, $channel)
    {
        $this->data = ApiEncResponse::encryptJson(["data" => $data]);       // Dynamic data
        $this->channel = $channel; // Dynamic channel
    }

    public function broadcastOn()
    {
        return new Channel($this->channel); // Broadcast on dynamic channel
    }
}
