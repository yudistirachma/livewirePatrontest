<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name, $email, $position, $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$email,$position,$password)
    {
        switch ($position) {
            case "1":
                $this->position = 'Pimpinan Redaktur';
                break;
            case "2":
                $this->position = 'Redaktur';
                break;
            case "3":
                $this->position = 'Jurnalis';
                break;
            default:
                $this->position = 'Unknown';
                break;
        }

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
