<?php

namespace App\Listeners;

use App\Notifications\newMessage;
use App\Events\MessageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageCreatedNotifications implements ShouldQueue
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
    public function handle(MessageCreated $event): void
    {
        $receiver = $event->message->receiver;
        if ($receiver->enable_notifications) {
            $receiver->notify(new newMessage($event->message));
        }
    }
}
