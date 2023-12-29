<?php

namespace App\Listeners;

use App\Events\ChangeStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\mailNotifications;
use Modules\OrderManagement\Entities\Order;
use Modules\UserManagement\Entities\User;

class SendDeliveryNotification
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
    public function handle(ChangeStatus $event): void
    {

        $order = Order::where('id',  $event->data['id'])->first();
        $user = User::where('id', $order->customer_id)->first();
        $data = [
            'subject' => 'Order Status Update Notification',
            'greeting' => 'Hello' . ' ' .   $user->firstname . '!',
            'line1' => 'Order Item  ' . $order->reference . '  under the Order Id ' . $order->finalize_order_id . ' is ' .   $event->data['status'],
            'line2' => 'You Can Track Your Orders Via ' . $order->finalize_order_id,
            'line3' => 'Thank you for using our application!'
        ];
        $user->notify(new mailNotifications($data));
    }
}
