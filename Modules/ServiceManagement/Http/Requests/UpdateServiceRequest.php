<?php

namespace Modules\ServiceManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'category_id' => 'integer',
            'subcategory_id' => 'integer',
            'duration'  => 'integer',
            'high_quality' => 'required',
            'real_quality' => 'required',
        ];
    }
}
