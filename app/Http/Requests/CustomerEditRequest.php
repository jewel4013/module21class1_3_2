<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CustomerEditRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|unique:customers,phone,'.$this->route('customer')->id,
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'thana' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
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
