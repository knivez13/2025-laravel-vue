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

class DynamicPrivateBroadcastEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $user;
    public $channel;

    public function __construct($user, $data, $channel)
    {
        $this->user = $user;       // Dynamic user
        $this->data = ApiEncResponse::encryptJson(["data" => $data]);       // Dynamic data
        $this->channel = $channel; // Dynamic channel
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel($this->channel . '.' . $this->user->id), // Dynamic channel
        ];
    }
}
