<?php

namespace Modules\Auth\App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Modules\Auth\App\Notifications\SendVerificationNotification;

class SendVerificationListener implements ShouldQueue
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
    public function handle($event): void
    {
        $user = $event->user;

        Notification::send($user, new SendVerificationNotification($user->name, '123456'));
    }
}
