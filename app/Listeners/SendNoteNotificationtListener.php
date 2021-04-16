<?php

namespace App\Listeners;

use App\Events\CreateNoteEvent;
use App\Mail\NoteNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNoteNotificationtListener implements ShouldQueue
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
     * @param  CreateNoteEvent  $event
     * @return void
     */
    public function handle(CreateNoteEvent $event)
    {
        $sender = User::where('id', $event->note->user_id)->first();
        $role = $sender->roles[0]->name;
        $sender = $sender->name;
        $note = $event->note ;

        foreach ($event->group->users as $jurnalis) 
        {
            if ($role == 'pimpinan redaktur') {
                if ($jurnalis->email == $event->group->user->email) {
                    continue;
                }
            }
            Mail::to($jurnalis->email)->send(new NoteNotification($note, $sender, $role));
        }

        if ($role == 'pimpinan redaktur') 
        {
            Mail::to($event->group->user->email)->send(new NoteNotification($note, $sender, $role));
        }
    }
}
