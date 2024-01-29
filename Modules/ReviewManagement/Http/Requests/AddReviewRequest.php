<?php

namespace Modules\ReviewManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReviewRequest extends FormRequest
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
            "service" => "required",
            "order_id" => "required",
            'first_name' =>  "required",
            'last_name' =>  "required",
            'email' =>  "required",
            'rate' =>  "required|integer",
            'review' =>  "required",
        ];
    }
}
