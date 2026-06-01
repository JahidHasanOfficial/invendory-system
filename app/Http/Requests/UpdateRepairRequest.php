<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'from_branch_id' => ['required', 'exists:branches,id'],
            'repair_no' => ['required', 'string', 'max:50', 'unique:repairs,repair_no,' . $this->repair->id],
            'batch_no' => ['nullable', 'string', 'max:50'],
            'serial_no' => ['nullable', 'string', 'max:100'],
            'fault_description' => ['nullable', 'string'],
            'received_at_head_office' => ['nullable', 'date'],
            'repaired_by' => ['nullable', 'string', 'max:100'],
            'repair_cost' => ['nullable', 'numeric', 'min:0'],
            'repaired_date' => ['nullable', 'date'],
            'sent_back_to_branch' => ['nullable', 'date'],
            'courier_tracking_no' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:pending_receipt,in_repair,repaired,returned,beyond_repair'],
        ];
    }
}
