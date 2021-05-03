<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteContent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $content, $redaktur;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($content, $redaktur)
    {
        $this->content = $content;
        $this->redaktur = $redaktur;
    }
}
