<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|unique:catagories|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
            'is_popular' => 'nullable|boolean',
        ];
    }
}
