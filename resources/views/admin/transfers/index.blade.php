@extends('layouts.app')

@section('title', 'Transfers')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Transfers</h2>
        <a href="{{ route('admin.transfers.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create Transfer
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-exchange-alt me-2"></i>Transfer List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Transfer No</th>
                            <th>From Branch</th>
                            <th>To Branch</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transfers as $transfer)
                            <tr>
                                <td class="fw-bold">{{ $transfer->transfer_no }}</td>
                                <td>{{ $transfer->fromBranch ? $transfer->fromBranch->name : '-' }}</td>
                                <td>{{ $transfer->toBranch ? $transfer->toBranch->name : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($transfer->transfer_date)->format('d M, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $transfer->status == 'received' ? 'success' : ($transfer->status == 'cancelled' ? 'danger' : 'warning text-dark') }}">
                                        {{ ucfirst(str_replace('_', ' ', $transfer->status)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.transfers.edit', $transfer->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.transfers.destroy', $transfer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this transfer?');">
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
                                <td colspan="6" class="text-center py-4 text-muted">No transfers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $transfers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
