@extends('layouts.app')

@section('title', 'Workstations')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Workstations</h2>
        <a href="{{ route('admin.workstations.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Workstation
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-desktop me-2"></i>Workstation List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Lab</th>
                            <th>Branch</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workstations as $ws)
                            <tr>
                                <td class="fw-bold">{{ $ws->workstation_code }}</td>
                                <td>{{ $ws->lab ? $ws->lab->name : '-' }}</td>
                                <td>{{ $ws->lab && $ws->lab->branch ? $ws->lab->branch->name : '-' }}</td>
                                <td>{{ ucwords($ws->workstation_type) }}</td>
                                <td>
                                    @if($ws->status == 'empty')
                                        <span class="badge bg-secondary">Empty</span>
                                    @elseif($ws->status == 'occupied')
                                        <span class="badge bg-success">Occupied</span>
                                    @else
                                        <span class="badge bg-danger">Under Repair</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.workstations.edit', $ws->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.workstations.destroy', $ws->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this workstation?');">
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
                                <td colspan="6" class="text-center py-4 text-muted">No workstations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $workstations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
