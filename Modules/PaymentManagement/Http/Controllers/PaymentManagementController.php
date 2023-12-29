<?php

namespace Modules\PaymentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Events\CheckoutEvent;
use Modules\PaymentManagement\Repositaries\PaymentServicesInterfaces;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\PaymentGateways\Paypal;

use Exception;
use Modules\PaymentManagement\Http\Requests\PayPalRequest;

class PaymentManagementController extends Controller
{
    protected $paypal;
    protected $repositoryinterface;

    public function __construct(Paypal $paypalobject, PaymentServicesInterfaces $repositoryinterface)
    {
        $this->paypal = $paypalobject;
        $this->repositoryinterface = $repositoryinterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function processTrasaction(PayPalRequest $request)
    {
        try {
            $this->repositoryinterface->checkout($request->input());
            $responseData = $this->paypal->processTrasaction(
                'https://www.ifolo.co/success',
                'https://www.ifolo.co/',
                $request->validated()
            );
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function successTransaction()
    {
        try {
            $user = auth('api')->user();
            event(new CheckoutEvent($user));
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
