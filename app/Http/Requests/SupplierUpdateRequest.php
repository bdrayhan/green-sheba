<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'supplier_name' => 'required|string|max:255',
            'supplier_phone' => 'required|string|max:255',
            'wireHouse_address' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'supplier_name.required' => 'Supplier name is required',
            'supplier_phone.required' => 'Supplier phone is required',
            'wireHouse_address.required' => 'Supplier address is required',
        ];
    }
}
