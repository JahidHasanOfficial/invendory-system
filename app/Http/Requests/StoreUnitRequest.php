<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'short_name' => 'required|string|max:40',
            'full_name' => 'required|string|max:100',
            'status' => 'nullable|boolean',
        ];
    }
}
