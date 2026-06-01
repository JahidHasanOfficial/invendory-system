<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequisitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'requester_branch_id' => ['required', 'exists:branches,id'],
            'req_no' => ['required', 'string', 'max:50', 'unique:requisitions,req_no,' . $this->requisition->id],
            'requested_date' => ['required', 'date'],
            'required_by_date' => ['nullable', 'date', 'after_or_equal:requested_date'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'purpose' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,pending_bm,pending_hr,pending_cfo,approved,rejected,fulfilled,cancelled'],
        ];
    }
}
