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
        //    dd($data['randomnumber']
        $randomNumber = random_int(100000, 999999);
        $user =  auth('api')->user();

        if ($user != null) {
            $order = new Order();
            $order->reference = "RDV-" .   $randomNumber;
            $order->status = 'Added To Cart';
            $order->customer_id = $user->id;
            $order->order_details = $data['order_details'];
            $order->save();
            return  $order;
        } else {
            $order = new Order();
            $order->reference = "RDV-" .  $randomNumber;
            $order->status = 'Added To Cart';
            $order->order_details = $data['order_details'];
            $order->tempory_cart_id = $data['randomnumber'];
            $order->save();
            return  $order;
        }
    }
    public function index()
    {
        $orders = QueryBuilder::for(Order::class)
            ->allowedFilters(['status'])
            ->with('user')
            ->get();

        return  $orders;
    }
    public function cartorders($data)
    {
        $user =  auth('api')->user();
        if ($user != null) {
            if (!empty($data['tempory_cart_id'])) {
                $finalize_cart = [];
                $cartorders = Order::where('tempory_cart_id', $data['tempory_cart_id']);
                $finalize_cart1 = $cartorders->where('status', 'Added To Cart')->get(['reference', 'order_details', 'status', 'id']);

                $cartorders1 = Order::where('customer_id', $user->id);
                $finalize_cart2 = $cartorders1->where('status', 'Added To Cart')->get(['reference', 'order_details', 'status', 'id']);

                foreach ($finalize_cart1 as $item) {
                    array_push($finalize_cart, $item);
                }

                foreach ($finalize_cart2  as $item) {
                    array_push($finalize_cart, $item);
                }

                // $finalize_cart = [
                //     // 'random' => $finalize_cart1,
                //     // 'useradded' =>  $finalize_cart2
                // ];
                return $finalize_cart;
            } else {

                $cartorders = Order::where('customer_id', $user->id);
                $finalize_cart = $cartorders->where('status', 'Added To Cart')->get(['reference', 'order_details', 'status', 'id']);
                return $finalize_cart;
            }
        } else {
            if ($data['tempory_cart_id'] != null) {
                $finalize_cart = [];
                $cartorders = Order::where('tempory_cart_id', $data['tempory_cart_id']);
                $finalize_cart = $cartorders->where('status', 'Added To Cart')->get(['reference', 'order_details', 'status', 'id']);
                return $finalize_cart;
            }
        }
    }

    public function deleteorder($id)
    {
        $response =  $id->delete();
        return $response;
    }
}
