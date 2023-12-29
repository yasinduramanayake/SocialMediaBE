<?php

namespace App\Listeners;

use App\Events\CheckoutEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\mailNotifications;
use Modules\OrderManagement\Entities\Order;

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
    public function handle(CheckoutEvent $event): void
    {

        $cartDetails = Order::where('customer_id', $event->user->id);
        $cartFilter =   $cartDetails->where('status', 'Pending')->get();

        $data = [
            'subject' => 'Order Creation Notification',
            'greeting' => 'Hello' . ' ' .  $event->user->firstname . '!',
            'line1' => 'Your Order Has Been Succesfully Placed.',
            'line2' => 'You Can Track Your Orders Via ' . $cartFilter[0]['finalize_order_id'],
            'line3' => 'Thank you for using our application!'
        ];
        $event->user->notify(new mailNotifications($data));
    }
}
