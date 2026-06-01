<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'unit_id' => 'nullable|exists:units,id',
        ];
    }
}
