<?php

namespace App\Listeners;

use App\Events\AdminToUserEvent;
use App\Notifications\AdminToUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminToUserNotification implements ShouldQueue
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
    public function handle(AdminToUserEvent $event): void
    {
        $event->user->notify(
            new AdminToUserNotification($event->message)
        );
    }
}
