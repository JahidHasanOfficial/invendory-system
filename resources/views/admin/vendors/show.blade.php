@extends('layouts.app')

@section('page_title', 'Vendor Details')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Vendor Details</h4>
        <div>
            <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-primary shadow-sm ms-2">
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
                        <td>{{ $vendor->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Name</th>
                        <td>{{ $vendor->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Contact Person</th>
                        <td>{{ $vendor->contact_person }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Phone</th>
                        <td>{{ $vendor->phone }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Email</th>
                        <td>{{ $vendor->email }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Status</th>
                        <td>
                            @if(is_numeric($vendor->status))
                                @if($vendor->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            @else
                                <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $vendor->status) }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
