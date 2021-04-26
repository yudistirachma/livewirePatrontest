<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use App\Mail\CommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommentNotificationtListener implements ShouldQueue
{
    public function handle(CommentEvent $event)
    {
        if ($event->comment->user->id == $event->content->user->id) {

            if ($event->comment->user->id != $event->content->group->user->id) {
                Mail::to($event->content->group->user->email)->send(new CommentNotification($event->content,$event->comment));
            }

        }elseif($event->comment->user->id == $event->content->group->user->id) {
            
            if ($event->comment->user->id != $event->content->user->id) {
                Mail::to($event->content->user->email)->send(new CommentNotification($event->content,$event->comment));
            }

        }else {
            
            Mail::to($event->content->user->email)->send(new CommentNotification($event->content,$event->comment));

            Mail::to($event->content->group->user->email)->send(new CommentNotification($event->content,$event->comment));
        
        }

    }
}
