<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\RegisterUserEvent' => [
            'App\Listeners\SendUserAccountListener',
        ],
        'App\Events\CreateGroupEvent' => [
            'App\Listeners\SendNewGroupNotificationtListener'
        ],
        'App\Events\CreateNoteEvent' => [
            'App\Listeners\SendNoteNotificationtListener'
        ],
        'App\Events\CommentEvent' => [
            'App\Listeners\SendCommentNotificationtListener'
        ],
        'App\Events\ValidationEvent' => [
            'App\Listeners\SendValidationNotificationtListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
