@extends('layouts.app')

@section('page_title', 'Goods Receipt Details')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Goods Receipt Details</h4>
        <div>
            <a href="{{ route('admin.goods-receipts.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('admin.goods-receipts.edit', $goods_receipt->id) }}" class="btn btn-primary shadow-sm ms-2">
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
                        <td>{{ $goods_receipt->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Gr No</th>
                        <td>{{ $goods_receipt->gr_no }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Received Date</th>
                        <td>{{ $goods_receipt->received_date }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Status</th>
                        <td>
                            @if(is_numeric($goods_receipt->status))
                                @if($goods_receipt->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            @else
                                <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $goods_receipt->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Notes</th>
                        <td>{{ $goods_receipt->notes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
