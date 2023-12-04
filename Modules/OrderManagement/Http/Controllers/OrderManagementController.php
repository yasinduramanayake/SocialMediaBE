<?php

namespace Modules\OrderManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Modules\OrderManagement\Repositaries\OrderServicesInterfaces;
use Modules\OrderManagement\Http\Requests\AddOrderRequest;
use Modules\OrderManagement\Http\Requests\UpdateOrderStatus;

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
        try {
            $responseData = $this->repositoryinterface->changeStatus(
                $request->validated()
            );
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cartOrders()
    {
        try {
            $responseData = $this->repositoryinterface->cartOrders();
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
