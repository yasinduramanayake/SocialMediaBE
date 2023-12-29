<?php

namespace Modules\UserManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return  [
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|string|email:rfc,dns|unique:users",
            "password" =>  "required|min:6|confirmed",
            "address" => "string",
            'view' => 'required'
        ];
    }
}
