<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        $customerRoute = $this->route('customer');
        // যদি রাউট থেকে সরাসরি মডেল অবজেক্ট আসে তবে তার আইডি নেওয়া হবে, অন্যথায় র-আইডি নেওয়া হবে 
        $customerId = $customerRoute instanceof \App\Models\Customer ? $customerRoute->id : $customerRoute;
        return [
            'name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|unique:customers,phone,'.$customerId, // ক্যাসিক টেক্সট-এর সাথে লুপের আইডি মিললে সেটি selected হয়ে থাকবে
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
