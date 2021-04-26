<?php

namespace App\Listeners;

use App\Events\ValidationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendValidationNotificationtListener
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
     * @param  ValidationEvent  $event
     * @return void
     */
    public function handle(ValidationEvent $event)
    {
        //
    }
}
