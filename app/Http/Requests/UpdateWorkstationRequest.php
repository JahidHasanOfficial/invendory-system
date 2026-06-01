<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkstationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_id' => ['required', 'exists:labs,id'],
            'workstation_code' => ['required', 'string', 'max:50'],
            'workstation_type' => ['required', 'in:student,instructor,server'],
            'status' => ['required', 'in:empty,occupied,under_repair'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
