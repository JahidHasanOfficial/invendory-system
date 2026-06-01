<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_branch_id' => ['required', 'exists:branches,id'],
            'to_branch_id' => ['required', 'exists:branches,id', 'different:from_branch_id'],
            'transfer_no' => ['required', 'string', 'max:50', 'unique:transfers,transfer_no,' . $this->transfer->id],
            'transfer_date' => ['required', 'date'],
            'courier_name' => ['nullable', 'string', 'max:100'],
            'courier_tracking_no' => ['nullable', 'string', 'max:100'],
            'courier_cost' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,approved,in_transit,received,cancelled'],
        ];
    }
}
