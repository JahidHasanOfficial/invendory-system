@extends('layouts.app')

@section('title', 'Labs')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Labs</h2>
        <a href="{{ route('admin.labs.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Lab
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-laptop-house me-2"></i>Lab List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Branch</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($labs as $lab)
                            <tr>
                                <td class="fw-bold">{{ $lab->lab_code }}</td>
                                <td>{{ $lab->name }}</td>
                                <td>{{ $lab->branch ? $lab->branch->name : '-' }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $lab->lab_type)) }}</td>
                                <td>{{ $lab->capacity }}</td>
                                <td>
                                    @if($lab->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.labs.edit', $lab->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.labs.destroy', $lab->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lab?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No labs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $labs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
