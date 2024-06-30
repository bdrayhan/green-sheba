<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnOrderStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'or_order_date' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
            'product_code' => 'required',
            'or_return_qtn' => 'required',
            'or_return_reason' => 'required',
        ];
    }
}
