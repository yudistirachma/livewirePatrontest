<?php

namespace App\Listeners;

use App\Events\ValidationEvent;
use App\Mail\ValidationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendValidationNotificationtListener implements ShouldQueue
{
    public function handle(ValidationEvent $event)
    {
        return Mail::to($event->content->user->email)->send(new ValidationNotification($event->content));
    }
}
