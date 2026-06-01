@extends('layouts.app')

@section('title', 'Repairs & Service')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Repairs & Service</h2>
        <a href="{{ route('admin.repairs.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create Repair
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tools me-2"></i>Repair List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Repair No</th>
                            <th>Product</th>
                            <th>From Branch</th>
                            <th>Serial No</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($repairs as $repair)
                            <tr>
                                <td class="fw-bold">{{ $repair->repair_no }}</td>
                                <td>{{ $repair->product ? $repair->product->name : '-' }}</td>
                                <td>{{ $repair->branch ? $repair->branch->name : '-' }}</td>
                                <td>{{ $repair->serial_no ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $repair->status == 'repaired' || $repair->status == 'returned' ? 'success' : ($repair->status == 'beyond_repair' ? 'danger' : 'warning text-dark') }}">
                                        {{ ucfirst(str_replace('_', ' ', $repair->status)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.repairs.edit', $repair->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.repairs.destroy', $repair->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this repair?');">
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
                                <td colspan="6" class="text-center py-4 text-muted">No repairs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $repairs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
