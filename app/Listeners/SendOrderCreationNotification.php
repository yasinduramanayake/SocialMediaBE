<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\mailNotifications;

class SendOrderCreationNotification
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
    public function handle(OrderCreate $event): void
    {
        $user =  auth('api')->user();
        $data = [
            'subject' => 'Order Creation Notification',
            'greeting' => 'Hello' . ' ' .  $user->firstname . '!',
            'line1' => 'Your Order Has Been Succesfully Placed.',
            'line2' => 'Thank you for using our application!'
        ];
        $event->user->notify(new mailNotifications($data));
    }
}
