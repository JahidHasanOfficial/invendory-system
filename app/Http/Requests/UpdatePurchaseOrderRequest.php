<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendor_id' => ['required', 'exists:vendors,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'po_no' => ['required', 'string', 'max:50', 'unique:purchase_orders,po_no,' . $this->purchase_order->id],
            'order_date' => ['required', 'date'],
            'expected_delivery_date' => ['nullable', 'date', 'after_or_equal:order_date'],
            'delivery_address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,sent,approved,received,cancelled'],
        ];
    }
}
