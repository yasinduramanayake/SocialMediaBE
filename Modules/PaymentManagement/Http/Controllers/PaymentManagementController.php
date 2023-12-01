<?php

namespace Modules\PaymentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\PaymentGateways\Paypal;
use Exception;

class PaymentManagementController extends Controller
{

    protected $paypal;


    public function __construct(Paypal $paypalobject)
    {
        $this->paypal = $paypalobject;
    }
    /**
     * Display a listing of the resource.
     */
    public function processTrasaction()
    {
        try {
            $responseData  =  $this->paypal->processTrasaction('http://localhost:3000/' , 'http://localhost:3000/');
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paymentmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('paymentmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('paymentmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
