<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['required', 'exists:branches,id'],
            'name' => ['required', 'string', 'max:100'],
            'lab_code' => ['required', 'string', 'max:20'], // Unique check handled with branch_id uniquely in controller/db
            'lab_type' => ['required', 'in:training_lab,server_room,instructor_room,store_room'],
            'capacity' => ['required', 'integer', 'min:0'],
            'floor' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'status' => ['boolean'],
        ];
    }
}
