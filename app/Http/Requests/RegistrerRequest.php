<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Override;

class RegistrerRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'outlate'  => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // 🚀 এটি নিশ্চিত করবে যে ভ্যালিডেশন ভুল হলে পেজ রিফ্রেশ না হয়ে সরাসরি জেসন রেসপন্স আকারে Axios এর কাছে ভুলগুলো চলে যাবে
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first()
        ], 422));
    }
}
