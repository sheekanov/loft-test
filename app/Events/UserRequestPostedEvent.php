<?php

namespace App\Events;

use App\UserRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/*
* Это событие, которое мы будем вызывать при появлении новой заявки от клиента
*/
class UserRequestPostedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userRequest;

    public function __construct(UserRequest $userRequest)
    {
        $this->userRequest = $userRequest;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
