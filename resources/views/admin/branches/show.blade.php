@extends('layouts.app')

@section('page_title', 'Branch Details')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Branch Details</h4>
        <div>
            <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('admin.branches.edit', $branch->id) }}" class="btn btn-primary shadow-sm ms-2">
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
                        <td>{{ $branch->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Name</th>
                        <td>{{ $branch->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Code</th>
                        <td>{{ $branch->code }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Address</th>
                        <td>{{ $branch->address }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Contact Number</th>
                        <td>{{ $branch->contact_number }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Email</th>
                        <td>{{ $branch->email }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;" class="text-muted">Status</th>
                        <td>
                            @if(is_numeric($branch->status))
                                @if($branch->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            @else
                                <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $branch->status) }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
