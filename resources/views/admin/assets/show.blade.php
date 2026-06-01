@extends('layouts.app')

@section('page_title', 'Asset Assignment Details')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Asset Assignment Details</h4>
        <div>
            <a href="{{ route('admin.assets.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('admin.assets.edit', $asset->id) }}" class="btn btn-primary shadow-sm ms-2">
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
                        <td>{{ $asset->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Serial No</th>
                        <td>{{ $asset->serial_no }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Status</th>
                        <td>
                            @if(is_numeric($asset->status))
                                @if($asset->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            @else
                                <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $asset->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Assigned Date</th>
                        <td>{{ $asset->assigned_date }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Condition</th>
                        <td>{{ $asset->condition }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
