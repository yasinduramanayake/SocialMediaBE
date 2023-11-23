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
        $order = new Order();
        $order->status = 'Pending';
        $order->customer_id = 1;
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
}
