<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CatagoryStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:catagories,name|max:255',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
            'is_popular' => 'nullable|boolean',
            'show_home' => 'nullable|boolean',
            'show_menu' => 'nullable|boolean',
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
