<?php

namespace Modules\OrderManagement\Repositaries;

use Modules\OrderManagement\Entities\Order;
use Modules\CategoryManagement\Repositaries\CategoryServicesInterfaces;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;

class OrderServicesImplements implements OrderServicesInterfaces
{
    public function create($data)
    {
        $randomNumber = random_int(100000, 999999);

        $user =  auth('api')->user();
        $order = new Order();
        $order->reference = "RDV-" .   $randomNumber;
        $order->status = 'Pending';
        $order->customer_id = $user->id;
        $order->order_details = $data['order_details'];
        $order->save();
        // Order::create($data);

        return $order;
    }
    public function index()
    {
        $orders = QueryBuilder::for(Order::class)
            ->allowedFilters(['status'])
            ->get();

        return  $orders;
    }

    public function changeStatus($data)
    {
        $order = Order::where('id', $data['id'])->first();
        $order->status = $data['status'];
        $order->save();

        return $order;
    }

    public function cartorders()
    {
        $user =  auth('api')->user();
        $cartorders = Order::where('customer_id', $user->id)->get(['reference', 'order_details' , 'status' , 'id']);;
        return $cartorders;
    }
}
