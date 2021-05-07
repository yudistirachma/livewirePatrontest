<?php

namespace App\Listeners;

use App\Events\CreateContentEvent;
use App\Mail\CreateContentNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CreateContentNotificationListener implements ShouldQueue
{
    public function handle(CreateContentEvent $event)
    {
        $jurnalis = User::where('id', $event->data['user_id'])->first();

        Mail::to($jurnalis->email)->send(new CreateContentNotification($event->data, $jurnalis));
    }
}
