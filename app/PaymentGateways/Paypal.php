<?php

namespace App\PaymentGateways;





use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Paypal
{
    /**
     * Display a listing of the resource.
     */
    public function processTrasaction($return_url, $cancel_url)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => $return_url,
                "cancel_url" => $cancel_url,
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return response()->json(['data' => $links['href']], 200);
                }
            }
        }
        // } else {

        // }
    }
}
