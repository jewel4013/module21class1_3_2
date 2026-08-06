<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductUpdateRequest extends FormRequest
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
        $productSlug = $this->route('slug'); // রাউট থেকে প্রোডাক্টের স্লাগ বের করা
        return [
            'name'     => 'required|string|max:255|unique:products,name,'.$productSlug.',slug', // স্লাগের ভিত্তিতে ইউনিক চেক
            'brand_id' => 'nullable|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:catagories,id',
            'priority' => 'nullable|integer|min:0',
            'product_cost' => 'nullable|numeric|min:0|max:99999999',
            'product_price' => 'required|numeric|min:0|max:99999999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
            'multiple_images' => 'nullable|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,svg|max:4096',
            'description' => 'nullable|string|max:5000',
            'is_popular' => 'nullable|boolean',
            'show_home' => 'nullable|boolean',
            'show_menu' => 'nullable|boolean',
            'stock_quantity' => 'required|integer|min:1',
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
