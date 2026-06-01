@extends('layouts.app')

@section('title', 'Requisitions')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Requisitions</h2>
        <a href="{{ route('admin.requisitions.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create Requisition
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list me-2"></i>Requisition List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Req No</th>
                            <th>Branch</th>
                            <th>Requested By</th>
                            <th>Date</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requisitions as $req)
                            <tr>
                                <td class="fw-bold">{{ $req->req_no }}</td>
                                <td>{{ $req->branch ? $req->branch->name : '-' }}</td>
                                <td>{{ $req->requestedBy ? $req->requestedBy->name : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($req->requested_date)->format('d M, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $req->priority == 'high' || $req->priority == 'urgent' ? 'danger' : ($req->priority == 'medium' ? 'warning text-dark' : 'info') }}">
                                        {{ ucfirst($req->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $req->status == 'approved' ? 'success' : ($req->status == 'rejected' || $req->status == 'cancelled' ? 'danger' : 'secondary') }}">
                                        {{ ucfirst(str_replace('_', ' ', $req->status)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.requisitions.edit', $req->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.requisitions.destroy', $req->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this requisition?');">
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
                                <td colspan="7" class="text-center py-4 text-muted">No requisitions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $requisitions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
