<?php

namespace App\Listeners;

use App\Events\UserToAdminEvent;
use App\Notifications\UserToAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserToAdminNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserToAdminEvent $event): void
    {
        $event->user->notify(
            new UserToAdminNotification($event->message)
        );
    }
}
