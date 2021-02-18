<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Mail\UserAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserAccountListener implements ShouldQueue
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
     * @param  RegisterUserEvent  $event
     * @return void
     */
    public function handle(RegisterUserEvent $event)
    {
        return Mail::to($event->email)->send(new UserAccount($event->name,$event->email,$event->position,$event->password));
    }
}
