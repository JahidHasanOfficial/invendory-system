<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'serial_no' => ['required', 'string', 'max:100'],
            'branch_id' => ['required', 'exists:branches,id'],
            'lab_id' => ['nullable', 'exists:labs,id'],
            'workstation_id' => ['nullable', 'exists:workstations,id'],
            'assigned_to_user_id' => ['nullable', 'exists:users,id'],
            'assigned_date' => ['required', 'date'],
            'return_date' => ['nullable', 'date', 'after_or_equal:assigned_date'],
            'assignment_type' => ['required', 'in:permanent,temporary,lab_assigned'],
            'condition' => ['required', 'in:good,damaged,under_repair'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:assigned,returned,lost,disposed'],
        ];
    }
}
