<?php

namespace Modules\OrderManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Modules\OrderManagement\Repositaries\OrderServicesInterfaces;
use Modules\OrderManagement\Http\Requests\AddOrderRequest;
use Modules\OrderManagement\Http\Requests\UpdateOrderStatus;
use App\Events\ChangeStatus;
use Modules\OrderManagement\Entities\Order;

class OrderManagementController extends Controller
{

    protected $repositoryinterface;


    public function __construct(OrderServicesInterfaces $repositoryinterface)
    {
        $this->repositoryinterface = $repositoryinterface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $responseData  =  $this->repositoryinterface->index();
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ordermanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AddOrderRequest $request)
    {
        try {
            $responseData  =  $this->repositoryinterface->create($request->validated());
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function changeStatus(UpdateOrderStatus $request)
    {
        $data = $request->validated();
        try {
            event(new ChangeStatus($data));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cartOrders(Request $request)
    {
        $data = $request->input();
        try {
            $responseData = $this->repositoryinterface->cartOrders($data);
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function orderTracking(Request $request)
    {
        $data = $request->validate([
            'tracking_number' => 'required'
        ]);
        try {
            $trackingorders = Order::where('finalize_order_id', $data['tracking_number'])->get();
            return response()->json(['data' => $trackingorders], 200);
            // if($trackingorders === []){

            // }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function deleteorder(Order $id)
    {
        try {
            $responseData  =  $this->repositoryinterface->deleteorder($id);
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
