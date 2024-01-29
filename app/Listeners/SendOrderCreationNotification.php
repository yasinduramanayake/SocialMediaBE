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
            'greeting' => 'Dear' . ' ' .  $event->user->firstname . ',',
            'line1' => 'We are delighted to inform you that your order has been successfully placed with us! Below, you will find the essential details to track your order and stay updated on its status:',
            'line2' => 'Order Confirmation:' . $cartFilter[0]['finalize_order_id'],
            'line3' => 'Feel free to use this unique order code for quick and easy tracking through our application.',
            'line4' => 'We sincerely appreciate your trust in our services and hope that your experience with us exceeds your expectations. If you have any inquiries or require further assistance, please do not hesitate to reach out.',
            'line5' => 'Thank you for choosing our service for your Social Media Service needs. We look forward to serving you again in the future!'
        ];
        $event->user->notify(new mailNotifications($data));
    }
}
