@extends('layouts.app')

@section('title', 'Units')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Units</h2>
        @can('units.create')
        <a href="{{ route('admin.units.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Unit
        </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list me-2"></i>Unit List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">ID</th>
                            <th>Full Name</th>
                            <th>Short Name</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($units as $unit)
                            <tr>
                                <td>{{ $unit->id }}</td>
                                <td class="fw-bold">{{ $unit->full_name }}</td>
                                <td>{{ $unit->short_name }}</td>
                                <td>
                                    @if($unit->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('units.edit')
                                    <a href="{{ route('admin.units.edit', $unit->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('units.delete')
                                    <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this unit?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No units found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $units->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
