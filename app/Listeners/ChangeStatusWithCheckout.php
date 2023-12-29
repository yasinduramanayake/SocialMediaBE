<?php

namespace App\Listeners;

use App\Events\CheckoutEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\mailNotifications;
use Modules\OrderManagement\Entities\Order;

class ChangeStatusWithCheckout
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
        $randomNumber =  $randomNumber = random_int(1000000, 99999999);
        $order_id = "ORD-" . $randomNumber;
        $cartDetails = Order::where('customer_id', $event->user->id);

        $cartFilter =   $cartDetails->where('status', 'Added To Cart')->get();

        foreach ($cartFilter as $value) {
            $value->status = "Pending";
            $value->finalize_order_id = $order_id;
            $value->save();
        }
    }
}
