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
        Order::create($data);

        return $data;
    }
    public function index()
    {
        $orders = QueryBuilder::for(Order::class)
            ->allowedFilters(['status'])
            ->get();

        return  $orders;
    }
}
