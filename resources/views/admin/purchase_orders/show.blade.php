@extends('layouts.app')

@section('page_title', 'Purchase Order Details')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Purchase Order Details</h4>
        <div>
            <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('admin.purchase-orders.edit', $purchase_order->id) }}" class="btn btn-primary shadow-sm ms-2">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <tbody>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Id</th>
                        <td>{{ $purchase_order->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Po No</th>
                        <td>{{ $purchase_order->po_no }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Order Date</th>
                        <td>{{ $purchase_order->order_date }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Expected Delivery Date</th>
                        <td>{{ $purchase_order->expected_delivery_date }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Total Amount</th>
                        <td>{{ $purchase_order->total_amount }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Status</th>
                        <td>
                            @if(is_numeric($purchase_order->status))
                                @if($purchase_order->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            @else
                                <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $purchase_order->status) }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
