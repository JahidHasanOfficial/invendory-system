@extends('layouts.app')

@section('page_title', 'Transfer Details')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Transfer Details</h4>
        <div>
            <a href="{{ route('admin.transfers.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('admin.transfers.edit', $transfer->id) }}" class="btn btn-primary shadow-sm ms-2">
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
                        <td>{{ $transfer->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Transfer No</th>
                        <td>{{ $transfer->transfer_no }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Transfer Date</th>
                        <td>{{ $transfer->transfer_date }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Status</th>
                        <td>
                            @if(is_numeric($transfer->status))
                                @if($transfer->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            @else
                                <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $transfer->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Courier Name</th>
                        <td>{{ $transfer->courier_name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Courier Tracking No</th>
                        <td>{{ $transfer->courier_tracking_no }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Courier Cost</th>
                        <td>{{ $transfer->courier_cost }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
