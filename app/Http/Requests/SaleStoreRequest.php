<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id'    => 'required|integer',
            'sub_total'      => 'required|numeric|min:0|max:99999999',
            'discount'       => 'nullable|numeric|min:0|max:99999999',
            'grand_total'    => 'required|numeric|min:0|max:99999999',
            'paid_amount'    => 'required|numeric|min:0|max:99999999',
            'due_amount'     => 'required|numeric|min:0|max:99999999',
            'payment_type'   => 'required|string|max:255',  
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'  =>  false,
            'errors' => $validator->errors()->all(),
        ], 422));
    }
}
