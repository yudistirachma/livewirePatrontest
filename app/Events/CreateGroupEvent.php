<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateGroupEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $redaktur, $group, $journalist;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($group, $redaktur, $journalist)
    {
        $this->group = $group;
        $this->redaktur = $redaktur;
        $this->journalist = $journalist;
    }
}
