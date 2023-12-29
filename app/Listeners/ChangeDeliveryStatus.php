<?php

namespace App\Listeners;

use App\Events\ChangeStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\mailNotifications;
use Modules\OrderManagement\Entities\Order;

class ChangeDeliveryStatus
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
        $id =  $event->data['id'];
        $status =  $event->data['status'];
        $order = Order::where('id', $id)->first();
        $order->status =  $status;
        $order->save();
    }
}
