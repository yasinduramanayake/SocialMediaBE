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

        if ($event->data['status'] === 'In Progress') {
            $data = [
                'subject' => 'Order Status Update Notification',
                'greeting' => 'Dear' . ' ' .   $user->firstname . '!',
                'line1' => 'We are excited to inform you that the status of your order is now In Progress. Your selected item with Order Id' . $order->finalize_order_id . ', under the reference ' . $order->reference . ', is currently being prepared for delivery.',
                // 'line1' =>   'Order Item  ' . $order->reference . '  under the Order Id ' . $order->finalize_order_id . ' is ' .   $event->data['status'],
                'line2' => 'To stay up-to-date with the real-time progress of your order, you can conveniently track it using the Order Id' . $order->finalize_order_id . 'We want to ensure that you are well-informed throughout the delivery process.',
                // 'line2' => 'You Can Track Your Orders Via ' . $order->finalize_order_id,
                'line3' => 'Thank you for choosing our application! If you have any questions or require further assistance, feel free to reach out to our dedicated support team.',
                'line4' => '',
                'line5' => ''
            ];
        } else if ($event->data['status'] === 'Completed') {
            $data = [
                'subject' => 'Order Status Update Notification',
                'greeting' => 'Dear' . ' ' .   $user->firstname . '!',
                'line1' =>   'We are delighted to share the fantastic news that your order has been successfully delivered! The item with Order Id' . $order->finalize_order_id . ',  and  reference ' . $order->reference . ', is now in your hands.',
                'line2' => 'We sincerely appreciate your trust in our service. Should you have any queries or need further assistance, please do not hesitate to contact our dedicated support team.',
                'line3' => 'Thank you for choosing Followsta!',
                'line4' => 'We wish you a lot of success in business and an excellent stay.',
                'line5' => 'Keep coming back..!'
            ];
        }
        $user->notify(new mailNotifications($data));
    }
}
