<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content, $comment ;

    /**
     *
     * @return void
     */
    public function __construct($content, $comment)
    {
        $this->content = $content;
        $this->comment = $comment;
    }
}
