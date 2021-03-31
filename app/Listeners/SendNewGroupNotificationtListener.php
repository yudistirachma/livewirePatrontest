<?php

namespace App\Listeners;

use App\Events\CreateGroupEvent;
use App\Mail\GroupNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewGroupNotificationtListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateGroupEvent  $event
     * @return void
     */
    public function handle(CreateGroupEvent $event)
    {
        Mail::to($event->redaktur['email'])->send(new GroupNotification($event->redaktur['name'], $event->group, $event->redaktur['name'], $event->journalist));
        
        foreach($event->journalist as $journalist)
        {
            Mail::to($journalist['email'])->send(new GroupNotification($journalist['name'], $event->group, $event->redaktur['name'], $event->journalist));
        }
    }
}
