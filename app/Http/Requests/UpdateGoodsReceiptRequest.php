<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoodsReceiptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'po_id' => ['required', 'exists:purchase_orders,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'gr_no' => ['required', 'string', 'max:50', 'unique:goods_receipts,gr_no,' . $this->goods_receipt->id],
            'received_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,completed'],
        ];
    }
}
