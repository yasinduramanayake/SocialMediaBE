<?php

namespace Modules\PaymentManagement\Repositaries;

use Modules\OrderManagement\Entities\Order;
use Modules\CategoryManagement\Repositaries\CategoryServicesInterfaces;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;


class PaymentServicesImplements implements PaymentServicesInterfaces
{
    public function checkout($data)
    {
        $user =  auth('api')->user();

        if ($user != null && !empty($data['tempory_cart_id'])) {
            $orders =  Order::where('tempory_cart_id', $data['tempory_cart_id'])->get();

            foreach ($orders as $order) {
                if ($order->customer_id === null) {
                    $order->customer_id = $user->id;
                    $order->save();
                }
            }
        }
    }
}
