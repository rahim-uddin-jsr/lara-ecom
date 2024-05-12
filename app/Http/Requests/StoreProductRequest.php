<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:250|required',
            'description' => 'string|max:400|required',
            'price' => 'numeric',
            'quantity' => 'integer|min:0',
            'sku' => 'string',
            'brand' => 'string|max:200',
            'category_id' => 'string',
            'images.*' => 'image|mimetypes:image/jpeg,image/png,image/gif|max:1024',
        ];
    }
}
