<?php

namespace Modules\PaymentManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayPalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }
}
